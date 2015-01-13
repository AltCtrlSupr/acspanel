<?php
/**
 * HttpdAliasRepository
 *
 * @author genar
 */
namespace ACS\ACSPanelBundle\Model;

use ACS\ACSPanelUsersBundle\Doctrine\AclEntityRepository;

class FtpdUserRepository extends AclEntityRepository
{
    public function findByUsers(Array $user)
    {
        $query = $this->_em->createQuery('SELECT f FROM ACS\ACSPanelBundle\Entity\FtpdUser f WHERE f.user IN (?1)')->setParameter(1, $user);
        return $query->getResult();
    }
}
