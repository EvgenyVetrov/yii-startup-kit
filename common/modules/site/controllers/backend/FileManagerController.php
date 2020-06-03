<?php

namespace modules\site\controllers\backend;

use modules\site\models\backend\Directory;
use modules\site\models\backend\File;
use modules\site\models\backend\UploadForm;
use modules\site\models\backend\DirectoryForm;
use yii\data\ArrayDataProvider;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class FileManagerController extends Controller
{
    /**
     * @param null $path
     *
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionIndex($path = null)
    {
        if (strstr($path, '../')) {
            throw new BadRequestHttpException();
        }

        $directory = Directory::createByPath($path);

        return $this->render('index', [
            'directory'    => $directory,
            'dataProvider' => new ArrayDataProvider(['allModels' => $directory->list])
        ]);
    }


    /**
     * @param $path
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionUpload($path)
    {
        if (strstr($path, '../')) {
            throw new BadRequestHttpException();
        }

        $directory = Directory::createByPath($path);

        $model       = new UploadForm();
        $model->path = $path;

        if (\Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstances($model, 'files');

            if ($model->upload()) {
                return $this->redirect(['file-manager/index', 'path' => $model->path]);
            }
        }

        return $this->render('upload-file', [
            'directory' => $directory,
            'model'     => $model
        ]);
    }


    /**
     * @param $path
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionDelete($path)
    {
        if (strstr($path, '../')) {
            throw new BadRequestHttpException();
        }

        $file = File::createByPath($path);

        unlink($file->fullPath);

        return $this->redirect(['file-manager/index', 'path' => $file->directory->path]);

    }


    /**
     * @param null|string $path
     *
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionCreate($path = null)
    {
        if (strstr($path, '../')) {
            throw new BadRequestHttpException();
        }

        $model       = new DirectoryForm();
        $model->path = $path;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['file-manager/index', 'path' => $model->path]);
        } else {
            Yii::error($model->errors);
        }

        return $this->render('create-dir', [
            'model'     => $model,
            'directory' => Directory::createByPath($path)
        ]);
    }


    /**
     * @param $path
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionUpdate($path)
    {
        if (strstr($path, '../')) {
            throw new BadRequestHttpException();
        }

        $directory = Directory::createByPath($path);

        $model           = new DirectoryForm();
        $model->path     = $directory->parent->path;
        $model->name     = $directory->name;
        $model->newName     = $directory->name;
        $model->scenario = DirectoryForm::SCENARIO_RENAME;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'path' => $model->path]);
        } else {
            Yii::error($model->errors);
        }

        return $this->render('update-dir', [
            'model'     => $model,
            'directory' => $directory
        ]);
    }


    /**
     * @param $path
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     * @throws \yii\base\ErrorException
     */
    public function actionDeleteDir($path)
    {
        if (strstr($path, '../')) {
            throw new BadRequestHttpException();
        }

        $directory = Directory::createByPath($path);

        FileHelper::removeDirectory($directory->fullPath);

        return $this->redirect(['default/index', 'path' => $directory->parent->path]);
    }
}