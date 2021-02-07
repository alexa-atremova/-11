<?php

namespace App\Controller;

use App\Exception\ValidationException;
use App\Model\Ads;

class AdsController
{
    public function index()
    {
        $ads = Ads::findAll();

        $data = [
            'title' => 'Ads',
            'adsAll' => $ads
        ];
        return view('ads.ads_list', $data);
    }

    public function create(): string
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $errors = [];
            $data = $_POST;
            if (empty($data['adsTitle'])) {
                $errors['adsTitle'] = 'Cannot be empty';
            }
            if (strlen($data['adsTitle']) > Ads::ADS_TITLE_MAX) {
                $errors['adsTitle'] = 'Сannot be more than 100 characters';
            }
            if (empty($data['body'])) {
                $errors['body'] = 'Cannot be empty';
            }
            if (strlen($data['body']) > Ads::ADS_BODY_MAX) {
                $errors['body'] = 'Сannot be more than 1000 characters';
            }
            if ($errors) {
                throw new ValidationException($errors);
            }
            $data['adsTitle'] = filter_var($data['adsTitle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data['body'] = filter_var($data['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ads = new Ads(
                $data['adsTitle'],
                $data['body'],
            );
            Ads::save($ads);
            header('Location: /ads');
            exit;
        }
        $data = [
            'title' => 'Ads create',
        ];
        return view('ads.ads_create', $data);
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            Ads::remove($id);
        }
        header('Location: /ads');
        exit;
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            header('Location: /ads');
            exit;
        }

        $id = (int)$_GET['id'];
        $ads = Ads::findById($id);
        if (!$ads) {
            header('Location: /ads');
            exit;
        }

        $data = [
            'title' => 'Ads ' . $ads['title'],
            'ads' => $ads
        ];

        return view('ads.ads_update', $data);
    }
}