<?php
namespace Core\Model;
class User
{
    /**
     * _firstName 
     * 
     * @var string
     * @access protected
     */
    protected $_firstName;

    /**
     * _lastName 
     * 
     * @var string
     * @access protected
     */
    protected $_lastName;

    /**
     * Get firstName.
     *
     * @return firstName
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }
 
    /**
     * Set firstName.
     *
     * @param string $firstName the value to be set
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
        return $this;
    }
 
    /**
     * Get lastName.
     *
     * @return lastName
     */
    public function getLastName()
    {
        return $this->_lastName;
    }
 
    /**
     * Set lastName.
     *
     * @param string $lastName the value to be set
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
        return $this;
    }
}
