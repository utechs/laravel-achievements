# Achievements
 Achievements system for Course portal
 Download package
 - Run composer install
 - php artisan test
# Adding new Achievement and Badge
 I decided to use http requests to store new achievement and badge, but it can be done by using Artisan command with stub class.
# Testing purposes
I added 2 methods in User Model to run my testing.

```

//$count number of lessons to be generated
public function completeLessons($count)
{
    for ($i = 1; $i <= $count; $i++) {
        $lesson = Lesson::findOrFail($i);
        $this->lessons()->attach($lesson->id, [
            'watched' => 1,
        ]);
        LessonWatched::dispatch($lesson, $this);
    }
}
```
```
//$count number of comments to be generated
public function addComments($count)
{
    for ($i = 1; $i <= $count; $i++) {
        $comment = Comment::factory()->create(['user_id' => $this->id]);
        CommentWritten::dispatch($comment);
    }
}
```
