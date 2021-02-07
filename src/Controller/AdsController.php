<?php

namespace App\Controller;

use App\Model\Ads;
use App\Exception\ValidationException;

class AdsController
{
    public function index()
    {
        $comments = Ads::findAll();

        $data = [
            'title' => 'Ads',
            'comments' => $comments
        ];

        return view('ads.ads_list', $data);
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function create(): string
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = [
                'title' => 'Ads Create',
            ];
            return view('ads.ads_create', $data);
        }

        $errors = [];
        $data = $_POST;
        if (empty($data['title'])) {
            $errors['title'] = 'Cannot be empty';
        }

        if (empty($data['comments'])) {
            $errors['comments'] = 'Cannot be empty';
        }

        if ($errors) {
            throw new ValidationException($errors);
        }

        $ads= new Ads(
            $data['title'],
            $data['comments']
        );

        Ads::save($ads);
        header('Location: /ads');
        exit;
    }
    public function delete(): void
    {
        if (isset($_GET['title'])) {
            $title = (string) $_GET['title'];
            Ads::remove($title);
        }
        header('Location: /ads');
        exit;
    }

    public function edit()
    {
        if (!isset($_GET['title'])) {
            header('Location: /ads');
            exit;
        }

        $title = (string) $_GET['title'];
        $comment = Ads::findByTitle($title);
        if (!$comment) {
            header('Location: /ads');
            exit;
        }

        $data = [
            'title' => 'Ads ' . $comment['comments'],
            'comments' => $comment
        ];
        return view('ads.ads_update', $data);
    }

}