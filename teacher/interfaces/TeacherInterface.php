<?php

interface TeacherInterface
{
    public function createCourse($courseName, $courseCode); 
    public function addAnnouncements($title, $des, $date, $teacherId, $courseId); 
}