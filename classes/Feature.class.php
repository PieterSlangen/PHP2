<?php
include_once("includes/db.inc.php");

class Feature
{
    private $m_sName;

    public function getMSName()
    {
        return $this->m_sName;
    }

    public function setMSName($m_sName)
    {
        $this->m_sName = $m_sName;
    }

    
}
