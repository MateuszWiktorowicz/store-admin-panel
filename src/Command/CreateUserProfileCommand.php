<?php

namespace App\Command;

use App\Entity\UserProfile;
use App\Repository\UserRepository;
use App\Repository\UserProfileRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'CreateUserProfileCommand',
    description: 'Add a user profile command',
)]
class CreateUserProfileCommand extends Command
{
    public function __construct(
        private UserRepository $users,
        private UserProfileRepository $usersProfile
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('user', InputArgument::REQUIRED, 'User id')
            ->addArgument('address', InputArgument::REQUIRED, 'address of company')
            ->addArgument('phone', InputArgument::REQUIRED, 'phone number')
            ->addArgument('company_name', InputArgument::REQUIRED, 'Company name')
            ->addArgument('nip', InputArgument::REQUIRED, 'Nip')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $userId = $input->getArgument('user');
        $user = $this->users->find($userId);
        $address = $input->getArgument('address');
        $phone = $input->getArgument('phone');
        $company_name = $input->getArgument('company_name');
        $nip = $input->getArgument('nip');

        $userProfile = new UserProfile();
        $userProfile->setUser($user);
        $userProfile->setAddress($address);
        $userProfile->setPhone($phone);
        $userProfile->setCompanyName($company_name);
        $userProfile->setNip($nip);

        $this->usersProfile->add($userProfile, true);



        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
