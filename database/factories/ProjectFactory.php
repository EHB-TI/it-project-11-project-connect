<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

use App\Models\Space;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $markdownString = "
# Markdown Test String

## Subheader

This is a *quick* Markdown **test string** to check the parser functionality.

### Features

- **Bold text**: Like this **bold text**.
- *Italic text*: Like this *italic text*.
- `Code`: Inline `code` snippet.
- [Link](https://example.com): A hyperlink to [example.com](https://example.com).

#### Conclusion

That's a **basic test**! _Good luck_ with your parser!
        ";

        $userIds = User::pluck('id')->toArray();
        $ownerID = $this->faker->randomElement($userIds);

        $spaces = Space::pluck('id')->toArray();
        $spaceID = $this->faker->randomElement($spaces);

        return [
         'name' => $this->faker->unique()->word,
         'description' => $markdownString,
         'status' => $this->faker->randomElement(['Pending', 'Approved', 'Denied', 'Closed', 'Published']),
         'ownerID' => $ownerID,
         'spaceID' => $spaceID,
        ];
    }
}

/*

# Markdown Test String

## Subheader

This is a *quick* Markdown **test string** to check the parser functionality.

### Features

- **Bold text**: Like this **bold text**.
- *Italic text*: Like this *italic text*.
- `Code`: Inline `code` snippet.
- [Link](https://example.com): A hyperlink to [example.com](https://example.com).

#### Conclusion

That's a **basic test**! _Good luck_ with your parser!

*/
