<?php
class WebUser extends CWebUser
{
    private $_profile = null;

    public function getProfile()
    {
        if (empty($this->_profile)) 
            $this->_profile = User::model()->findByPk(Yii::app()->user->id);
        return $this->_profile;
    }
}