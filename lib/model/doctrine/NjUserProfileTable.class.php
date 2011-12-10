<?php

/**
 * NjUserProfileTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class NjUserProfileTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object NjUserProfileTable
     */
       
    static public $state = array(
        'Acre' => 'Acre',
        'Alagoas' => 'Alagoas',
        'Amapá' => 'Amapá',
        'Amazonas' => 'Amazonas',
        'Bahia' => 'Bahia',
        'Ceará' => 'Ceará°',
        'Distrito Federal' => 'Distrito Federal',
        'Goiás' => 'Goiás',
        'Espírito Santo' => 'Espírito Santo',
        'Maranhão' => 'Maranhão',
        'Mato Grosso' => 'Mato Grosso',
        'Mato Grosso do Sul' => 'Mato Grosso do Sul',
        'Minas Gerais' => 'Minas Gerais',
        'Pará' => 'Pará',
        'Paraiba' => 'Paraiba',
        'Paraná' => 'Paraná',
        'Pernambuco' => 'Pernambuco',
        'Piauí' => 'Piauí',
        'Rio de Janeiro' => 'Rio de Janeiro',
        'Rio Grande do Norte' => 'Rio Grande do Norte',
        'Rio Grande do Sul' => 'Rio Grande do Sul',
        'Rondônia' => 'Rondônia',
        'Roraima'   => 'Roraima',
        'São Paulo' => 'São Paulo',
        'Santa Catarina' => 'Santa Catarina',
        'Sergipe'   => 'Sergipe',
        'Tocantins' => 'Tocantins'
    );
 
    public function getTypes()
    {
        return self::$state;
    }
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('NjUserProfile');
    }
}