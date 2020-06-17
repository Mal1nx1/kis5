<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends AbstractController
{
    public function getCompanies () {
        $companies = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();
        if (!$companies){
            return new Response("Таблица пуста!");
        }
        $arrayCollection = array();

        foreach($companies as $company) {
            $arrayCollection[] = array(
                'id' => $company->getId(),
                'name' => $company->getName(),
                'description' => $company->getDescription()
            );
        }
        return new JsonResponse($arrayCollection);
    }

    public function getCompany ($id) {
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($id);
        if (!$company){
            return new Response('Компания не найдена');
        }
        $companyJSON = [
            'id' => $company->getId(),
            'name' => $company->getName(),
            'description' => $company->getDescription(),
        ];
        return new JsonResponse($companyJSON);
    }

    public function createCompany (Request $request) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $company = new Company();
        $company->setName($request->request->get('name'));
        $company->setDescription($request->request->get('description'));
        $entityManager->persist($company);
        $entityManager->flush();
        return new Response('Компания успешно создана, идентификатор: '.$company->getId());
    }

    public function updateCompany ($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($id);
        if (!$company) {
            return new Response('Компания не существует');
        } else {
            $company->setName($request->request->get('name'));
            $company->setDescription($request->request->get('description'));
            $entityManager->flush();
            return new Response('Компания была успешно изменена, идентификатор: ' . $company->getId());
        }
    }

    public function deleteCompany ($id) {$entityManager = $this->getDoctrine()->getManager();
        $company = $entityManager->getRepository(Company::class)->find($id);
        if (!$company) return new Response('Компания не найдена');
        $entityManager->remove($company);
        $entityManager->flush();
        return new Response('Компания с идентификатором '.$id.' была успешно удалена');
    }
}
