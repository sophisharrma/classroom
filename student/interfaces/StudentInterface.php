<?php
interface StudentInterface
{
    public function joinCourse($courseCode);
    public function addCourseToStudent($courseId, $studentId);
}