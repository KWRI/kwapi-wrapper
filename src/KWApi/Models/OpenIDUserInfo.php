<?php namespace KWApi\Models;

/**
 * Class OpenIDUserInfo
 * @package KWApi\Models
 */
class OpenIDUserInfo
{
    private $kwUid;
    private $email;
    private $company;
    private $appName;

    /**
     * OpenIDUserInfo constructor.
     * @param $kwUid
     * @param $email
     * @param $company
     * @param $appName
     */
    public function __construct($kwUid, $email, $company, $appName)
    {
        $this->kwUid = $kwUid;
        $this->email = $email;
        $this->company = $company;
        $this->appName = $appName;
    }

    /**
     * Set KWUID
     * @param $kwUid
     */
    public function setKWUID($kwUid)
    {
        $this->kwUid = $kwUid;
    }

    /**
     * Get KWUID
     * @return mixed
     */
    public function getKWUID()
    {
        return $this->kwUid;
    }

    /**
     * Set Email
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get Email
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Company
     * @param $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * Get Company
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set App Name
     * @param $appName
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    /**
     * Get App Name
     * @return mixed
     */
    public function getAppName()
    {
        return $this->appName;
    }
}
