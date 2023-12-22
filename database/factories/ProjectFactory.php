<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

use App\Models\Space;

/**
 * @extends Factory<Project>
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
        // Make sure no indentation is used in the string below or the markdown parser will not work
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

        $user_ids = User::pluck('id')->toArray();
        $user_id = $this->faker->randomElement($user_ids);

        $spaces = Space::pluck('id')->toArray();
        $space_id = $this->faker->randomElement($spaces);

        return [
         'name' => $this->faker->unique()->word,
         'brief' => $this->faker->sentence,
         'description' => $markdownString,
         'status' => $this->faker->randomElement(['Pending', 'Approved', 'Denied', 'Closed', 'Published']),
         'user_id' => $user_id,
         'space_id' => $space_id,
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
