# Achievements
 Achievements system for Course portal
# Adding new Achievement and Badge
 I decided to use http requests to store new achievement and badge, but it can be done by using Artisan command with stub class.
# Testing purposes
I added 2 methods in User Model to run my testing.

```
public function completeLessons($size)
{
    for ($i = 1; $i <= $size; $i++) {
        $lesson = Lesson::findOrFail($i);
        $this->lessons()->attach($lesson->id, [
            'watched' => 1,
        ]);
        LessonWatched::dispatch($lesson, $this);
    }
}
```
```
public function addComments($size)
{
    for ($i = 1; $i <= $size; $i++) {
        $comment = Comment::factory()->create(['user_id' => $this->id]);
        CommentWritten::dispatch($comment);
    }
}
```
