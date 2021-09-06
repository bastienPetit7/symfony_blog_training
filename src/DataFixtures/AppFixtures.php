<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        

        $users = []; 
        
        for ($i=0; $i <50 ; $i++) { 
            
            $user = new User(); 
            $user->setUsername($faker->name); 
            $user->setFirstname($faker->firstName); 
            $user->setLastname($faker->lastName); 
            $user->setEmail($faker->email); 
            $user->setPassword($faker->password()); 
            $user->setCreatedAt(new \DateTimeImmutable()); 

            $manager->persist($user); 

            $users[] = $user; 
        }


        $categories = []; 

        for ($i=0; $i < 15 ; $i++) { 
            
            $category = new Category(); 
            $category->setTitle($faker->text(35));
            $category->setDescription($faker->text(120));
            $category->setImage($faker->imageUrl()); 

            $manager->persist($category); 

            $categories[] = $category; 

        }

         

        for ($i=0; $i <100 ; $i++) { 
            
            $article = new Article(); 
            $article->setTitle($faker->text(30));
            $article->setContent($faker->realText(3000, 2)); 
            $article->setImage($faker->imageUrl()); 
            $article->setCreatedAt(new \DateTimeImmutable()); 
            $article->addCategory($categories[$faker->numberBetween(0,14)]); 
            $article->setAuthor($users[$faker->numberBetween(0,49)]); 

            $manager->persist($article); 

        }

        
        // $manager->persist($product);

        $manager->flush();
    }
}
