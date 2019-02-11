<?php

namespace App\Repository;

class ScoreRepository implements ScoreInterface
{
    // get records from git hub
    public function getData($username)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get("https://api.github.com/users/$username/events/public");
            $response = $response->getBody()->getContents();

            return $this->setScore(json_decode($response));
        } catch (Exception $e) {
            return $e->getMessage;
        }
    }

    // set the score based on records
    public function setScore(array $data)
    {
        $params['scores'][] = ['name' => 'PushEvent', 'point' => 10, 'count' => $this->getScoreCount($data, 'PushEvent')];
        $params['scores'][] = ['name' => 'PullRequestEvent', 'point' => 5, 'count' => $this->getScoreCount($data, 'PullRequestEvent')];
        $params['scores'][] = ['name' => 'IssueCommentEvent', 'point' => 4, 'count' => $this->getScoreCount($data, 'IssueCommentEvent')];
        $params['scores'][] = ['name' => 'OtherEvent', 'point' => 1, 'count' => $this->getScoreCount($data, 'OtherEvent')];

        return $params;
    }

    public function getScoreCount(array $data, $type)
    {
        $score = collect($data);

        return ($type == 'OtherEvent') ? $score->whereNotIn('type', ['PushEvent', 'PullRequestEvent', 'IssueCommentEvent'])->count() : $score->where('type', $type)->count();
    }
}
