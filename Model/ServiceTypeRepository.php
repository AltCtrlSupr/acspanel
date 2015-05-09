<?php
/**
 * ServiceTypeRepository
 *
 * @author genar
 */
namespace ACS\ACSPanelBundle\Model;

use ACS\ACSPanelUsersBundle\Doctrine\AclEntityRepository;

class ServiceTypeRepository extends AclEntityRepository
{
    public function getDbServiceTypesIds()
    {
        $query = $this->_em->createQuery('SELECT st FROM ACS\ACSPanelBundle\Entity\ServiceType st LEFT JOIN st.parent_type pst WHERE st.name = ?1 OR pst.name = ?1 OR pst.name = ?2')->setParameter(1, 'DB')->setParameter(2, 'Database');
        $result = $query->getResult();
        $ids = array();

        foreach ($result as $key => $st) {
            $ids[] = $st->getId();
        }
        return $ids;

    }

    public function getDNSServiceTypesIds()
    {
        $query = $this->_em->createQuery('SELECT st FROM ACS\ACSPanelBundle\Entity\ServiceType st LEFT JOIN st.parent_type pst WHERE st.name = ?1 OR pst.name = ?1 OR pst.name = ?2')->setParameter(1, 'DNS')->setParameter(2, 'DNS');
        $result = $query->getResult();
        $ids = array();

        foreach ($result as $key => $st) {
            $ids[] = $st->getId();
        }
        return $ids;

    }

    public function getWebServiceTypesIds()
    {
        $query = $this->_em->createQuery('SELECT st FROM ACS\ACSPanelBundle\Entity\ServiceType st LEFT JOIN st.parent_type pst WHERE st.name LIKE ?1 OR pst.name LIKE ?1 OR st.name LIKE ?2 OR pst.name LIKE ?2')->setParameter(1, '%Web%')->setParameter(2, '%HTTP%');
        return $query->getResult();
    }

    public function getWebproxyServiceTypesIds()
    {
        $query = $this->_em->createQuery('SELECT st FROM ACS\ACSPanelBundle\Entity\ServiceType st LEFT JOIN st.parent_type pst WHERE st.name LIKE ?1 OR pst.name LIKE ?1 OR st.name LIKE ?2 OR pst.name LIKE ?2')->setParameter(1, '%Webproxy%')->setParameter(2, '%HTTP proxy%');
        return $query->getResult();

    }

    public function getUserViewable($user)
    {
		$entities_raw = $this->_em->createQuery('SELECT st FROM ACS\ACSPanelBundle\Entity\ServiceType st');
		$entities = $this->getAclFilter()->apply($entities_raw, ['VIEW'], $user, 'st')->getResult();

        return $entities;
    }


}
