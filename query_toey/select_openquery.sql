IF OBJECT_ID('c1r36.dbo.contents', 'U') IS NOT NULL DROP table c1r36.dbo.contents; 
SELECT * INTO c1r36.dbo.contents FROM openquery(MYSQL, 'SELECT * FROM c1r36.contents');

IF OBJECT_ID('c1r36.dbo.content_categories', 'U') IS NOT NULL DROP table c1r36.dbo.content_categories; 
SELECT * INTO c1r36.dbo.content_categories FROM openquery(MYSQL, 'SELECT * FROM c1r36.content_categories');

IF OBJECT_ID('c1r36.dbo.n_amphur', 'U') IS NOT NULL DROP table c1r36.dbo.n_amphur; 
SELECT * INTO c1r36.dbo.n_amphur FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_amphur');

IF OBJECT_ID('c1r36.dbo.n_area', 'U') IS NOT NULL DROP table c1r36.dbo.n_area; 
SELECT * INTO c1r36.dbo.n_area FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_area');

IF OBJECT_ID('c1r36.dbo.n_area_detail', 'U') IS NOT NULL DROP table c1r36.dbo.n_area_detail; 
SELECT * INTO c1r36.dbo.n_area_detail FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_area_detail');

IF OBJECT_ID('c1r36.dbo.n_district', 'U') IS NOT NULL DROP table c1r36.dbo.n_district; 
SELECT * INTO c1r36.dbo.n_district FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_district');

IF OBJECT_ID('c1r36.dbo.n_document', 'U') IS NOT NULL DROP table c1r36.dbo.n_document;
SELECT * INTO c1r36.dbo.n_document FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_document');

IF OBJECT_ID('c1r36.dbo.n_document_detail', 'U') IS NOT NULL DROP table c1r36.dbo.n_document_detail;
SELECT * INTO c1r36.dbo.n_document_detail FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_document_detail');

IF OBJECT_ID('c1r36.dbo.n_history', 'U') IS NOT NULL DROP table c1r36.dbo.n_history;
SELECT * INTO c1r36.dbo.n_history FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_history');

IF OBJECT_ID('c1r36.dbo.n_historydead', 'U') IS NOT NULL DROP table c1r36.dbo.n_historydead;
SELECT * INTO c1r36.dbo.n_historydead FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_historydead');

IF OBJECT_ID('c1r36.dbo.n_identify', 'U') IS NOT NULL DROP table c1r36.dbo.n_identify;
SELECT * INTO c1r36.dbo.n_identify FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_identify');


IF OBJECT_ID('c1r36.dbo.n_identify_detail', 'U') IS NOT NULL DROP table c1r36.dbo.n_identify_detail;
SELECT * INTO c1r36.dbo.n_identify_detail FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_identify_detail');

IF OBJECT_ID('c1r36.dbo.n_information', 'U') IS NOT NULL DROP table c1r36.dbo.n_information;
SELECT * INTO c1r36.dbo.n_information FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_information');

IF OBJECT_ID('c1r36.dbo.n_level_user', 'U') IS NOT NULL DROP table c1r36.dbo.n_level_user;
SELECT * INTO c1r36.dbo.n_level_user FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_level_user');

IF OBJECT_ID('c1r36.dbo.n_logs', 'U') IS NOT NULL DROP table c1r36.dbo.n_logs;
SELECT * INTO c1r36.dbo.n_logs FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_logs');

IF OBJECT_ID('c1r36.dbo.n_occupations', 'U') IS NOT NULL DROP table c1r36.dbo.n_occupations;
SELECT * INTO c1r36.dbo.n_occupations FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_occupations');

IF OBJECT_ID('c1r36.dbo.n_permissions', 'U') IS NOT NULL DROP table c1r36.dbo.n_permissions;
SELECT * INTO c1r36.dbo.n_permissions FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_permissions');


IF OBJECT_ID('c1r36.dbo.n_position', 'U') IS NOT NULL DROP table c1r36.dbo.n_position;
SELECT * INTO c1r36.dbo.n_position FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_position');

IF OBJECT_ID('c1r36.dbo.n_province', 'U') IS NOT NULL DROP table c1r36.dbo.n_province;
SELECT * INTO c1r36.dbo.n_province FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_province');

IF OBJECT_ID('c1r36.dbo.n_question', 'U') IS NOT NULL DROP table c1r36.dbo.n_question;
SELECT * INTO c1r36.dbo.n_question FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_question');

IF OBJECT_ID('c1r36.dbo.n_question_detail', 'U') IS NOT NULL DROP table c1r36.dbo.n_question_detail;
SELECT * INTO c1r36.dbo.n_question_detail FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_question_detail');

IF OBJECT_ID('c1r36.dbo.n_search', 'U') IS NOT NULL DROP table c1r36.dbo.n_search;
SELECT * INTO c1r36.dbo.n_search FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_search');

IF OBJECT_ID('c1r36.dbo.n_search_detail', 'U') IS NOT NULL DROP table c1r36.dbo.n_search_detail;
SELECT * INTO c1r36.dbo.n_search_detail FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_search_detail');

IF OBJECT_ID('c1r36.dbo.n_right', 'U') IS NOT NULL DROP table c1r36.dbo.n_right;
SELECT * INTO c1r36.dbo.n_right FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_right');

IF OBJECT_ID('c1r36.dbo.n_user', 'U') IS NOT NULL DROP table c1r36.dbo.n_user;
SELECT * INTO c1r36.dbo.n_user FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_user');

IF OBJECT_ID('c1r36.dbo.n_vaccine', 'U') IS NOT NULL DROP table c1r36.dbo.n_vaccine;
SELECT * INTO c1r36.dbo.n_vaccine FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_vaccine');
UPDATE n_vaccine  SET vaccine_date  = DATEADD(YEAR, -543,vaccine_date) where year(vaccine_date)>2500;


IF OBJECT_ID('c1r36.dbo.webboard_answers', 'U') IS NOT NULL DROP table c1r36.dbo.webboard_answers;
SELECT * INTO c1r36.dbo.webboard_answers FROM openquery(MYSQL, 'SELECT * FROM c1r36.webboard_answers');

IF OBJECT_ID('c1r36.dbo.webboard_categories', 'U') IS NOT NULL DROP table c1r36.dbo.webboard_categories;
SELECT * INTO c1r36.dbo.webboard_categories FROM openquery(MYSQL, 'SELECT * FROM c1r36.webboard_categories');

IF OBJECT_ID('c1r36.dbo.webboard_post_levels', 'U') IS NOT NULL DROP table c1r36.dbo.webboard_post_levels;
SELECT * INTO c1r36.dbo.webboard_post_levels FROM openquery(MYSQL, 'SELECT * FROM c1r36.webboard_post_levels');

IF OBJECT_ID('c1r36.dbo.webboard_quizs', 'U') IS NOT NULL DROP table c1r36.dbo.webboard_quizs;
SELECT * INTO c1r36.dbo.webboard_quizs FROM openquery(MYSQL, 'SELECT * FROM c1r36.webboard_quizs');

IF OBJECT_ID('c1r36.dbo.webboard_relate_dels', 'U') IS NOT NULL DROP table c1r36.dbo.webboard_relate_dels;
SELECT * INTO c1r36.dbo.webboard_relate_dels FROM openquery(MYSQL, 'SELECT * FROM c1r36.webboard_relate_dels');

IF OBJECT_ID('c1r36.dbo.webboard_status_configs', 'U') IS NOT NULL DROP table c1r36.dbo.webboard_status_configs;
SELECT * INTO c1r36.dbo.webboard_status_configs FROM openquery(MYSQL, 'SELECT * FROM c1r36.webboard_status_configs');

IF OBJECT_ID('c1r36.dbo.n_hospital', 'U') IS NOT NULL DROP table c1r36.dbo.n_hospital;
SELECT * INTO c1r36.dbo.n_hospital FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_hospital');

IF OBJECT_ID('c1r36.dbo.n_hospital_1', 'U') IS NOT NULL DROP table c1r36.dbo.n_hospital_1;
SELECT * INTO c1r36.dbo.n_hospital_1 FROM openquery(MYSQL, 'SELECT * FROM c1r36.n_hospital_1');