<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Vacancy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VacancyController extends AbstractController
{
    public function getVacancies ($companyId) {
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($companyId);
        if (!$company) return new Response('Компания с идентификатором '.$companyId.' не найдена');
        $vacancies = $company->getVacancies();
        if (count($vacancies)===0) return new Response('Компания '.$company->getName().' не имеет вакансий');
        $arrayCollection = array();

        foreach($vacancies as $vacancy) {
            $arrayCollection[] = array(
                'id' => $vacancy->getId(),
                'name' => $vacancy->getName(),
                'description' => $vacancy->getDescription(),
                'minSalary' => $vacancy->getMinSalary(),
                'maxSalary' => $vacancy->getMaxSalary(),
                'minExperience' => $vacancy->getminExperience(),
                'maxExperience' => $vacancy->getMaxExperience(),
                'companyId' => $vacancy->getCompany()->getId()
            );
        }

        return new JsonResponse($arrayCollection);
    }

    public function getVacancy ($id) {
        $vacancy = $this->getDoctrine()
            ->getRepository(Vacancy::class)
            ->find($id);
        if (!$vacancy){
            return new Response('Вакансия не найдена');
        }
        $vacancyJSON = [
            [
                'id' => $vacancy->getId(),
                'name' => $vacancy->getName(),
                'description' => $vacancy->getDescription(),
                'minSalary' => $vacancy->getMinSalary(),
                'maxSalary' => $vacancy->getMaxSalary(),
                'minExperience' => $vacancy->getminExperience(),
                'maxExperience' => $vacancy->getMaxExperience(),
                'companyId' => $vacancy->getCompany()->getId()
            ]
        ];
        return new JsonResponse($vacancyJSON);
    }

    public function createVacancy (Request $request): Response {
        $entityManager = $this->getDoctrine()->getManager();
        $vacancy = new Vacancy();
        $companyId = $request->request->get('companyId');
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($companyId);
        if(!$company){
            return new Response('Компания не найдена');
        }
        $vacancy->setCompany($company);
        $vacancy->setName($request->request->get('name'));
        $vacancy->setDescription($request->request->get('description'));
        $vacancy->setMinSalary($request->request->get('minSalary'));
        $vacancy->setMaxSalary($request->request->get('maxSalary'));
        $vacancy->setMinExperience($request->request->get('minExperience'));
        $vacancy->setMaxExperience($request->request->get('maxExperience'));
        $entityManager->persist($vacancy);
        $entityManager->flush();
        return new Response('Вакансия с идентификатором '.$vacancy->getId().' успешно создана');
    }

    public function updateVacancy ($id, Request $request) : Response {
        $entityManager = $this->getDoctrine()->getManager();
        $vacancy = $this->getDoctrine()
            ->getRepository(Vacancy::class)
            ->find($id);
        if (!$vacancy) {
            return new Response('Вакансия не существует');
        }
        $companyId = $request->request->get('companyId');
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($companyId);
        if(!$company){
            return new Response('Компания не найдена');
        }
        $vacancy->setCompany($company);
        $vacancy->setName($request->request->get('name'));
        $vacancy->setDescription($request->request->get('description'));
        $vacancy->setMinSalary($request->request->get('minSalary'));
        $vacancy->setMaxSalary($request->request->get('maxSalary'));
        $vacancy->setMinExperience($request->request->get('minExperience'));
        $vacancy->setMaxExperience($request->request->get('maxExperience'));
        $entityManager->flush();
        return new Response('Вакансия с идентификатором '.$vacancy->getId().' успешно изменена');
    }

    public function deleteVacancy ($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $vacancy = $entityManager->getRepository(Vacancy::class)->find($id);
        if (!$vacancy) return new Response('Вакансия не найдена');
        $entityManager->remove($vacancy);
        $entityManager->flush();
        return new Response('Вакансия с идентификатором '.$id.' была успешно удалена');
    }
}
