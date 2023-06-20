<?php
namespace App\Controller;

use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PropertyCreation extends AbstractController
{
    public function __construct(
    ) {}
    public function __invoke(Property $property): Property
    {
       $property->setLabel((new AsciiSlugger())->slug($property->getName()) );
        return $property;
    }
}