<?php
namespace App\Controller;

use App\Entity\Proposal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ProposalSubmission extends AbstractController
{
    public function __construct(
    ) {}
    public function __invoke(Proposal $proposal): Proposal
    {
        #compare les properties des chats et des humain si match la proposition est accepté
        return $proposal;
    }
}