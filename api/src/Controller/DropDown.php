<?php
declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
final class DropDown extends AbstractController
{
    public function __invoke(iterable $data)
    {
        return $data;
    }
}
