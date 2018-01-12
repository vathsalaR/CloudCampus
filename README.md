# CloudCampus

Flow:
1) Clean the database.
	Assume the class table is given in the system.

2) SIGN UP two students and two professors.
	Functionalities
	a) Password Restrictions
	b) Email Restrictions
	c) Role Choice.
	Output:
	When the validations are not fulfilled new account is not created.
	If the user is able to sign up there will be two effects on the backend.
	We can see a entry for this user in Login table and Notifications table.

3) Login with a user who has student role.
	Functionalities:
	a) We maintain Session of the user across the pages.
	b) We applied role based restrictions to access different parts of our website.
		This can be tested by logging into two different profiles
		i) Student, where you can see Enroll Class tab, View Enrolled Classes tab, Ask Questions specific to Student.
		ii) Professor, where you can see Add Videos and Answer Questions specific to Professors.
	c) We show the list of classes that are available for enrollment and allow students to enroll.
		i) Validation for duplicate enrollment is handled.
		ii) Validation for dropping without enrolling is also handled.
		To test the application Enroll to few classes.
	d) All the enrolled classes are shown in the View Enrolled Classes as a dropdown.
	e) In alignment with our project goal we provide students with access to live streaming of classes that are hosted on a public cloud.
	   To test this functionality Professor has to post a video and hence we will now move on to professor view.
	f) Apart from providing the live streaming we also maintain a stack of all the classes taught till date for each subject. (Here we have
	   considered the students who cannot make it to the class.)   

4) Login with a user who has professor role.
	Functionalities:
	a) The Subjects thaught by the professor are enlisted.
	b) We let professors add their online streaming classes url here.

5) Now Login with a user who has student role.
	Functionalities:
	a) In the View Enrolled Classes you can see the URL that the professor has posted in the above step.
		Given that student is enrolled to that class.
	b) Now go to Ask Questions tab in the student role.  For all the enrolled classes you can post a question.
	   These questions are sent to the respective Professor teaching the course. The professor can either choose to answer when the class
	   is going on or later when he finds some time. We provided a provision to perform both.
	c) The Questions asked can be seen in the Answer Questions section for the Professor.
	d) We also notify the professor about the above action. Notifications are a vital part of our system and indispensable.
	To verify this functionality we will have to again login as a professor of the subjec to which this question is posted.

6) Login with a user who has professor role.
	Functionalities:
	a) Under the Answer Questions section the question posted by the student can be found. We only show the professor the unanswered questions considering the flood of messages that he recieves. 
	b) Professor can post his answer through the same interface.
	c) We can also see a Notification in the professors Notiifications tab about the question posted.

7) Login with a user who has student role:
	a) Now Login to the AsK Question section and see the answer posted by the Professor.
	b) Also, the student recieves a notification regarding the same.
	c) A student is also notified about the classes he/she has missed through Notifications.
