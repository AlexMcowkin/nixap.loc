<?php

namespace app\models;

use Yii;

class Users extends \yii\db\ActiveRecord
{
    public $child_id=0;
    public $parent_id=0;
    public $hidden;

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['child_name', 'parent_name'], 'required'],
            [['child_name', 'parent_name'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'child_name' => 'Child Name',
            'parent_name' => 'Parent Name',
        ];
    }

    public function getUsersTrees()
    {
        return $this->hasMany(UsersTree::className(), ['parent_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){

            if($this->hidden == "addchild")
            {
                \Yii::$app->db->createCommand()->update(UsersTree::tableName(), ['child_id' => $this->id], 'parent_id='.$this->parent_id)->execute();

                $userstree = new UsersTree;
                $userstree->child_id = 0;
                $userstree->parent_id = $this->id;
                $userstree->save();                
            }
            else{
                $userstree = new UsersTree;
                $userstree->child_id = $this->child_id;
                $userstree->parent_id = $this->id;
                $userstree->save();                
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }


    public function countUserParents($id)
    {
        $string = $this->recursiveParents($id);
        $array = explode('-', $string);
        return count($array);
    }

    public function buildUserParentsTree($id)
    {
        $string = $this->recursiveParents($id);
        $array = explode('-', $string);

        array_pop($array);
        array_unshift($array, $id);

        foreach ($array as $key => $value) {
            $parents[] = Users::find()->select('parent_name')->where(['id' => $value])->asArray()->one();
        }

        $cnt = count($parents);
        $type = '';
        for ($i=0; $i<$cnt; $i++) { 
            if ($i == 0) {
              $type = 'father';
            }
            elseif ($i == 1){
              $type = 'grand '.$type;
            }
            else{
              $type = 'grand '.$type;
            }
            
            $arr[] = ['type'=>$type, 'name'=>$parents[$i]['parent_name']];
        }

        return $arr;
    }

    public function buildUserChildTree($id)
    {
        $string = $this->recursiveChild($id);
        $array = explode('-', $string);
        array_pop($array);
        array_pop($array);
        array_unshift($array, $id);

        foreach ($array as $key => $value) {
            $children[] = Users::find()->select('child_name')->where(['id' => $value])->asArray()->one();
        }

        $cnt = count($children);
        $type = '';
        for ($i=0; $i<$cnt; $i++) { 
            if ($i == 0) {
              $type = 'son';
            }
            elseif ($i == 1){
              $type = 'grand '.$type;
            }
            else{
              $type = 'grand '.$type;
            }
            
            $arr[] = ['type'=>$type, 'name'=>$children[$i]['child_name']];
        }

        return $arr;
    }

    protected function recursiveParents($id)
    {
        $parentId = UsersTree::find()->select('parent_id')->where(['child_id'=>$id])->asArray()->one();
        if($parentId)
        {
            return $parentId['parent_id'] .'-'. $this->recursiveParents($parentId['parent_id']);
        }
        
        return;
    }

    protected function recursiveChild($id)
    {
        $childId = UsersTree::find()->select('child_id')->where(['parent_id'=>$id])->asArray()->one();
        if($childId)
        {
            return $childId['child_id'] .'-'. $this->recursiveChild($childId['child_id']);
        }
        
        return;
    }

    public function checkIfHasGrandfather($id)
    {
        $childId = UsersTree::find()->select('parent_id')->where(['child_id'=>$id])->asArray()->one();
        
        if($childId)
        {
            return true;
        }

        return false;
    }

    public function checkIfHasGrandson($id)
    {
        $exists = UsersTree::find()->where(['child_id'=>0, 'parent_id'=>$id])->exists();
        
        if($exists)
        {
            return true;
        }

        return false;
    }
    
}
