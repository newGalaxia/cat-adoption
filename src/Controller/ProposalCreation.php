<?php
namespace App\Controller;

use App\Entity\Proposal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ProposalCreation extends AbstractController
{
    public function __construct(
    ) {}
    public function __invoke(Proposal $proposal): Proposal
    {
        # check si l'humain qui fait la proposition a au moins 3 properties à offrir au chat
        return $proposal;
    }
}