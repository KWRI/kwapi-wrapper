<?php

  namespace KWAPI\Models;

  /**
   *
   */
  class OpenIDUserInfo
  {
    private $kwUid;
    private $email;
    private $company;
    private $appName;
    
    public function __construct($kwUid, $email, $company, $appName)
    {
      $this->kwUid = $kwUid;
      $this->email = $email;
      $this->company = $company;
      $this->appName = $appName;
      
    }

    public function setKWUID($kwUid)
    {
      $this->kwUid = $kwUid;
    }

    public function getKWUID()
    {
      return $this->kwUid;
    }

    public function setEmail($email)
    {
      $this->email = $email;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function setCompany($company)
    {
      $this->company = $company;
    }

    public function getCompany()
    {
      return $this->company;
    }

    public function setAppName($appName)
    {
      $this->appName = $appName;
    }

    public function getAppName()
    {
      return $this->appName;
    }

  }
