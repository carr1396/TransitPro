<?php
  namespace TransitPro\Presenters;
  use Laracasts\Presenter\Presenter;

  class UserPresenter extends Presenter {

    public function lastLoginDifference(){
      return $this->last_login_at->diffForHumans();
    }

  }
