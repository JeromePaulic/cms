<?php

namespace App\Model;

class InstallModel
{
    const SITE_TITLE_LABEL = 'Titre du site web';
    const SITE_TITLE_NAME = 'website_title';

    const SITE_INSTALLED_LABEL = 'Site installé';
    const SITE_INSTALLED_NAME = 'website_installed';


    private ?string $siteTitle;

    private ?string $username;

    private ?string $password;

    /**
     * @return string|null
     */
    public function getSiteTitle(): ?string
    {
        return $this->siteTitle;
    }

    /**
     * @param string|null $siteTitle
     */
    public function setSiteTitle(?string $siteTitle): void
    {
        $this->siteTitle = $siteTitle;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }




}