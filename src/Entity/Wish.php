<?php

    namespace App\Entity;

    use App\Repository\WishRepository;
    use DateTimeInterface;
    use Doctrine\DBAL\Types\Types;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: WishRepository::class)]
    class Wish
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[
            ORM\Column(length: 250),
            Assert\NotBlank(message: 'We need a title for your wish '),
            Assert\Length(
                min: 2,
                max: 250,
                minMessage: 'Minimum 5 characters please',
                maxMessage: 'Maximum 250 characters please'
            )
        ]
        private ?string $title = null;

        #[
            ORM\Column(type: Types::TEXT, nullable: true),
            Assert\Length(max: 5000, maxMessage: "Maximum 5000 characters please")
        ]
        private ?string $description = null;

        #[
            ORM\Column(length: 50),
            Assert\NotBlank(message: 'All of us want to know who had this good idea'),
            Assert\Length(
                min: 2,
                max: 50,
                minMessage: 'Minimum 2 characters please!',
                maxMessage: 'Maximum 50 characters please!'
            ),
            Assert\Regex(pattern: '/^[a-z0-9_-]+$/i', message: 'Please use only letters, numbers, underscores and dashes!')
        ]
        private ?string $author = null;

        #[ORM\Column]
        private ?bool $isPublished = null;

        #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
        private ?DateTimeInterface $dateCreated = null;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getTitle(): ?string
        {
            return $this->title;
        }

        public function setTitle(string $title): self
        {
            $this->title = $title;

            return $this;
        }

        public function getDescription(): ?string
        {
            return $this->description;
        }

        public function setDescription(?string $description): self
        {
            $this->description = $description;

            return $this;
        }

        public function getAuthor(): ?string
        {
            return $this->author;
        }

        public function setAuthor(string $author): self
        {
            $this->author = $author;

            return $this;
        }

        public function isIsPublished(): ?bool
        {
            return $this->isPublished;
        }

        public function setIsPublished(bool $isPublished): self
        {
            $this->isPublished = $isPublished;

            return $this;
        }

        public function getDateCreated(): ?DateTimeInterface
        {
            return $this->dateCreated;
        }

        public function setDateCreated(?DateTimeInterface $dateCreated): self
        {
            $this->dateCreated = $dateCreated;

            return $this;
        }
    }
