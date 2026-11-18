<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\Exceptions\DivineApiException;
use DivineApi\HttpClient;

/**
 * Astro Chatbot API endpoints (ask.divineapi.com): astrology answers grounded in a birth chart.
 *
 * Conversations are scoped per end user. One API key (you) has many user_id values
 * (your end users), and each user_id has many session_id values (separate
 * conversations), each with its own birth details. The same session_id under two
 * user_id values is two separate sessions.
 *
 * Needs an Astro Chatbot plan on the account. The SDK sends your API key and auth
 * token as the x-api-key and Authorization: Bearer headers.
 */
class ChatbotApi
{
    private const HOST = 'ask.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Send one message in a conversation and get the answer.
     *
     * The first message of a session must carry the birth details (day, month, year,
     * hour, min, gender, place, lat, lon, tzone; full_name and sec are optional).
     * Later messages in the same session reuse them until a new complete set is sent.
     *
     * Optional: depth (quick 20 credits, standard 30, deep 50), length_cap (short,
     * medium, full), language (any language name, or auto), school (western, vedic,
     * kp, lalkitab), lens (general, career, love, health, money, spiritual),
     * confidence (balanced, definitive, careful), sensitivity (standard, strict), and
     * free text tone, framing, assistant_name, brand_voice, sign_off and style_notes
     * (at most 500 characters).
     *
     * Returns request_id, answer, band, credits_charged and credits_remaining. A
     * message the guardrails block gets a free reply with blocked => true and a
     * block_reason. Use chatStream() to stream the answer.
     *
     * @param array{user_id: string|int, session_id: string|int, message: string} $params
     */
    public function chat(array $params): array
    {
        if (!empty($params['stream'])) {
            throw new \InvalidArgumentException('chat() returns one JSON answer; use chatStream() to stream it');
        }
        unset($params['stream']);

        return $this->http->postJson(self::HOST, '/chat', self::body($params));
    }

    /**
     * Same as chat(), but streams the answer while it is written.
     *
     * Yields ['delta' => '...'] events, then one last event with 'done' => true and
     * the fields chat() returns. That event's answer is the final cleaned-up text,
     * which can differ slightly from the joined deltas. The request is sent when the
     * loop starts. Throws a DivineApiException with code 502 if the answer fails
     * part-way; nothing is charged then.
     *
     *   foreach ($client->chatbot()->chatStream([...]) as $event) {
     *       if (isset($event['delta'])) echo $event['delta'];
     *   }
     *
     * @param array{user_id: string|int, session_id: string|int, message: string} $params
     * @return \Generator<int, array>
     */
    public function chatStream(array $params): \Generator
    {
        $params['stream'] = true;
        foreach ($this->http->postJsonStream(self::HOST, '/chat', self::body($params)) as $event) {
            if (!empty($event['error']) && empty($event['done'])) {
                throw new DivineApiException((string) $event['error'], 502, $event);
            }
            yield $event;
        }
    }

    /**
     * Short personal horoscope for one date, from the birth chart and that day's sky.
     *
     * date is YYYY-MM-DD, from 1900-01-01 to 2100-12-30. Every call needs the complete
     * birth details. Optional: depth (quick up to 20 words, standard 35-50, deep 50-80;
     * same credits as chat()) and language. Returns request_id, date, prediction,
     * moon_phase_today, credits_charged and credits_remaining. Each prediction is also
     * saved in the user's "horoscope-prediction" session, which sessions() and
     * session() show.
     *
     * @param array{user_id: string|int, date: string} $params
     */
    public function horoscopePrediction(array $params): array
    {
        unset($params['message'], $params['stream']);   // a message would make it a chat turn

        return $this->http->postJson(self::HOST, '/chat', self::body($params));
    }

    /**
     * Every conversation this end user has under your key, most recent first.
     *
     * Each has session_id, messages (count), started and last_active (Unix seconds)
     * and has_birth_details. Throws a DivineApiException with code 404 if the user_id
     * has no sessions yet.
     *
     * @param array{user_id: string|int} $params
     */
    public function sessions(array $params): array
    {
        return $this->http->postJson(self::HOST, '/sessions', self::body([
            'user_id' => $params['user_id'] ?? null,
        ]));
    }

    /**
     * One conversation's full history (messages oldest first, each with role, text and
     * ts, plus the stored birth_details), for restoring a chat screen. Throws a
     * DivineApiException with code 404 if the user_id or this user's session_id is
     * unknown.
     *
     * @param array{user_id: string|int, session_id: string|int} $params
     */
    public function session(array $params): array
    {
        return $this->http->postJson(self::HOST, '/session', self::body([
            'user_id' => $params['user_id'] ?? null,
            'session_id' => $params['session_id'] ?? null,
        ]));
    }

    /**
     * Permanently delete one conversation: its messages and stored birth details.
     *
     * Use it when your end user asks to be forgotten. Returns deleted, session_id and
     * messages_removed. Throws a DivineApiException with code 404 if the user_id or
     * this user's session_id is unknown.
     *
     * @param array{user_id: string|int, session_id: string|int} $params
     */
    public function deleteSession(array $params): array
    {
        return $this->http->postJson(self::HOST, '/session/delete', self::body([
            'user_id' => $params['user_id'] ?? null,
            'session_id' => $params['session_id'] ?? null,
        ]));
    }

    /**
     * Astro Chatbot credit balance for your key. Free.
     *
     * Returns state (active, expired or limit_reached), credits_remaining and expires
     * (YYYY-MM-DD). Throws a DivineApiException with code 404 if the account has no
     * Astro Chatbot plan.
     */
    public function balance(): array
    {
        return $this->http->postJson(self::HOST, '/balance', []);
    }

    /**
     * Drop nulls and send numbers as strings: the chatbot accepts only JSON strings
     * for its fields (day 24 or tzone 5.5 get a 422), while the rest of the SDK takes
     * numbers. Booleans stay booleans.
     */
    private static function body(array $params): array
    {
        $body = [];
        foreach ($params as $key => $value) {
            if ($value === null) {
                continue;
            }
            $body[$key] = is_int($value) || is_float($value) ? (string) $value : $value;
        }

        return $body;
    }
}
