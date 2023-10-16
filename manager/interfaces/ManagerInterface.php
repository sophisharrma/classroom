<?php
interface ManagerInterface
{
    public function addStudent();
    public function addTeacher();
    public function addCategory();

    public function addCourse();
    public function addCourseInCategory();
    public function addStudentInCourse();
    public function addTeacherInCourse();
}