<?php

/**
 * Actions
 * 
 * @autogenerated by Phalcon Developer Tools
 * @date 2018-05-19, 18:37:22
 */
class Actions extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $lable;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $create_at;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field lable
     *
     * @param string $lable
     * @return $this
     */
    public function setLable($lable)
    {
        $this->lable = $lable;

        return $this;
    }

    /**
     * Method to set the value of field path
     *
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Method to set the value of field create_at
     *
     * @param string $create_at
     * @return $this
     */
    public function setCreateAt($create_at)
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field lable
     *
     * @return string
     */
    public function getLable()
    {
        return $this->lable;
    }

    /**
     * Returns the value of field path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the value of field create_at
     *
     * @return string
     */
    public function getCreateAt()
    {
        return $this->create_at;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'actions';
    }

}
