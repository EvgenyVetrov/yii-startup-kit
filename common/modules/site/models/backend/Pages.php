<?php
/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 27.05.20
 * Time: 9:03
 */

namespace modules\site\models\backend;


use modules\site\models\BasePages;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class Pages extends BasePages
{
    /**
     * Возвращает массив id-шников блоков, связанных с этой страницей
     * @return array
     */
    public function getPagesBlocksIds()
    {
        if (!trim($this->blocks_ids)) {
            return [];
        }

        return explode(',' ,$this->blocks_ids);
    }


    /**
     * Добавление нового блока к старнице
     * без сохранения
     *
     * @param int $block_id
     * @return bool
     */
    public function addPageBlock(int $block_id)
    {
        // если уже в масииве, то добавлять не надо
        if (in_array($block_id, $this->getPagesBlocksIds())) {
            return true;
        }

        $newArr = $this->getPagesBlocksIds();
        $newArr[] = $block_id;
        asort($newArr);
        $this->blocks_ids = implode(',', $newArr);
    }


    /**
     * @return array
     */
    public function getDropdownBlocks()
    {
        $blocks = PagesBlocks::find()
            ->where(['NOT IN', 'id', $this->getPagesBlocksIds()])
            ->asArray()
            ->all();

        return ArrayHelper::map($blocks, 'id', 'name');
    }



    /**
     * @return ActiveDataProvider
     */
    public function getPageBlocksProvider()
    {
        $query = PagesBlocks::find()
            ->where(['id' => $this->getPagesBlocksIds()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}