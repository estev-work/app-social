<?php


use App\Project\User\Domain\AggregateRootInterface;
use App\Project\User\Domain\ValueObjects\CreatedDate;
use App\Project\User\Domain\ValueObjects\UpdatedDate;
use App\Project\User\Domain\ValueObjects\UserId;
use App\Project\User\Domain\ValueObjects\UserName;
use DateTimeImmutable;
use Exception;

class UserAggregate implements AggregateRootInterface
{
    protected UserId $id;
    protected UserName $userName;
    protected CreatedDate $createdAt;
    protected UpdatedDate $updatedAt;

    /**
     * @param UserId $id
     * @param UserName $userName
     * @param CreatedDate $createdAt
     * @param UpdatedDate $updatedAt
     */
    private function __construct(
        UserId $id,
        UserName $userName,
        CreatedDate $createdAt,
        UpdatedDate $updatedAt
    ) {
        $this->id = $id;
        $this->userName = $userName;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function make(
        ?string $userId = null,
        string $userName = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null
    ): self {
        return new UserAggregate(
            new UserId($userId),
            new UserName($userName),
            new CreatedDate($createdAt),
            new UpdatedDate($updatedAt),
        );
    }

    #region FUNCTIONS

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'userName' => $this->userName->getValue(),
            'createdAt' => $this->createdAt->toISO(),
            'updatedAt' => $this->updatedAt?->toISO(),
        ];
    }

    public function getId(): string
    {
        return $this->id->getValue();
    }

    /**
     * @throws Exception
     */
    public function changeUserName(string $newUserName): self
    {
        $this->userName->change($newUserName);
        return $this;
    }

    #endregion

    #region GETTERS
    public function getCreatedAt(): CreatedDate
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedDate
    {
        return $this->updatedAt;
    }

    public function getUserName(): UserName
    {
        return $this->userName;
    }

    #endregion
}