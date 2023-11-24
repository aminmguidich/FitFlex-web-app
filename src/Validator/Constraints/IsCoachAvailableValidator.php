<?php

namespace App\Validator\Constraints;

use App\Entity\Activites;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsCoachAvailableValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        // Ensure that the value is an instance of Activites
        if (!$value instanceof Activites) {
            // If not, you might want to log an error or handle it appropriately
            return;
        }

        $date = $value->getDateDeb();

        // Check if the coach is already assigned to an activity on the specified date
        $existingActivity = $this->entityManager->getRepository(Activites::class)
            ->findOneBy([
                'idUser' => $value->getIdUser(), // Assuming 'idUser' is the coach association in Activites entity
                'dateDeb' => $date,
            ]);

        if ($existingActivity) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}