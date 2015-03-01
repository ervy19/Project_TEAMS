<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Absolute_Positioner' => $vendorDir . '/dompdf/dompdf/include/absolute_positioner.cls.php',
    'Abstract_Renderer' => $vendorDir . '/dompdf/dompdf/include/abstract_renderer.cls.php',
    'Activity_Evaluation' => $baseDir . '/app/models/Activity_Evaluation.php',
    'Adobe_Font_Metrics' => $vendorDir . '/phenx/php-font-lib/classes/Adobe_Font_Metrics.php',
    'AssessmentItemsController' => $baseDir . '/app/controllers/AssessmentItemsController.php',
    'Assessment_Item' => $baseDir . '/app/models/Assessment_Item.php',
    'Assessment_Response' => $baseDir . '/app/models/Assessment_Response.php',
    'Assigned_Role' => $baseDir . '/app/models/Assigned_Role.php',
    'Attribute_Translator' => $vendorDir . '/dompdf/dompdf/include/attribute_translator.cls.php',
    'BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'Block_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/block_frame_decorator.cls.php',
    'Block_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/block_frame_reflower.cls.php',
    'Block_Positioner' => $vendorDir . '/dompdf/dompdf/include/block_positioner.cls.php',
    'Block_Renderer' => $vendorDir . '/dompdf/dompdf/include/block_renderer.cls.php',
    'CPDF_Adapter' => $vendorDir . '/dompdf/dompdf/include/cpdf_adapter.cls.php',
    'CSS_Color' => $vendorDir . '/dompdf/dompdf/include/css_color.cls.php',
    'Cached_PDF_Decorator' => $vendorDir . '/dompdf/dompdf/include/cached_pdf_decorator.cls.php',
    'Campus' => $baseDir . '/app/models/Campus.php',
    'Campus_Supervisor' => $baseDir . '/app/models/Campus_Supervisor.php',
    'CampusesController' => $baseDir . '/app/controllers/CampusesController.php',
    'CampusesTableSeeder' => $baseDir . '/app/database/seeds/CampusesTableSeeder.php',
    'Canvas' => $vendorDir . '/dompdf/dompdf/include/canvas.cls.php',
    'Canvas_Factory' => $vendorDir . '/dompdf/dompdf/include/canvas_factory.cls.php',
    'Cellmap' => $vendorDir . '/dompdf/dompdf/include/cellmap.cls.php',
    'ConfideSetupUsersTable' => $baseDir . '/app/database/migrations/2014_11_27_083207_confide_setup_users_table.php',
    'CreateActivityEvaluationsTable' => $baseDir . '/app/database/migrations/2014_11_28_22_create_activity_evaluations_table.php',
    'CreateAssessmentItemsTable' => $baseDir . '/app/database/migrations/2014_11_28_23_create_assessment_items_table.php',
    'CreateAssessmentResponsesTable' => $baseDir . '/app/database/migrations/2014_11_28_27_create_assessment_responses_table.php',
    'CreateCampusSupervisorsTable' => $baseDir . '/app/database/migrations/2014_11_28_32_create_campus_supervisors_table.php',
    'CreateCampusesTable' => $baseDir . '/app/database/migrations/2014_11_28_04_create_campuses_table.php',
    'CreateDeparmentScTable' => $baseDir . '/app/database/migrations/2014_11_28_11_create_deparment_sc_table.php',
    'CreateDepartmentSupervisorsTable' => $baseDir . '/app/database/migrations/2014_11_28_30_create_department_supervisors_table.php',
    'CreateDepartmentsTable' => $baseDir . '/app/database/migrations/2014_11_28_06_create_departments_table.php',
    'CreateEducationalAttainmentTable' => $baseDir . '/app/database/migrations/2014_11_28_12_create_educational_attainment_table.php',
    'CreateEmployeeDesignationsTable' => $baseDir . '/app/database/migrations/2014_11_28_13_create_employee_designations_table.php',
    'CreateEmployeesTable' => $baseDir . '/app/database/migrations/2014_11_28_01_create_employees_table.php',
    'CreateEtAddressedScTable' => $baseDir . '/app/database/migrations/2014_11_28_29_create_et_addressed_sc_table.php',
    'CreateEtQueuesTable' => $baseDir . '/app/database/migrations/2014_11_28_17_create_et_queues_table.php',
    'CreateExternalTrainingsTable' => $baseDir . '/app/database/migrations/2014_11_28_15_create_external_trainings_table.php',
    'CreateFocusAreaTable' => $baseDir . '/app/database/migrations/2014_11_28_19_create_focus_area_table.php',
    'CreateHRAccountsTable' => $baseDir . '/app/database/migrations/2014_11_28_03_create_hr_accounts_table.php',
    'CreateInternalTrainingsTable' => $baseDir . '/app/database/migrations/2014_11_28_16_create_internal_trainings_table.php',
    'CreateItAddressedScTable' => $baseDir . '/app/database/migrations/2014_11_28_28_create_it_addressed_sc_table.php',
    'CreateItParticipants' => $baseDir . '/app/database/migrations/2014_11_28_24_create_it_participants.php',
    'CreateNotificationsTable' => $baseDir . '/app/database/migrations/2015_11_28_34_create_notifications_table.php',
    'CreateParticipantAssessmentsTable' => $baseDir . '/app/database/migrations/2014_11_28_26_create_participant_assessments_table.php',
    'CreateParticipantAttendancesTable' => $baseDir . '/app/database/migrations/2014_11_28_25_create_participant_attendances_table.php',
    'CreatePositionScTable' => $baseDir . '/app/database/migrations/2014_11_28_10_create_position_sc_table.php',
    'CreatePositionsTable' => $baseDir . '/app/database/migrations/2014_11_28_07_create_positions_table.php',
    'CreateProgramSupervisorsTable' => $baseDir . '/app/database/migrations/2014_11_28_33_create_program_supervisors_table.php',
    'CreateRanksTable' => $baseDir . '/app/database/migrations/2014_11_28_08_create_ranks_table.php',
    'CreateSchoolsCollegesSupervisorsTable' => $baseDir . '/app/database/migrations/2014_11_28_31_create_schools_colleges_supervisors_table.php',
    'CreateSchoolsCollegesTable' => $baseDir . '/app/database/migrations/2014_11_28_05_create_schools_colleges_table.php',
    'CreateSkillsCompetenciesTable' => $baseDir . '/app/database/migrations/2014_11_28_09_create_skills_competencies_table.php',
    'CreateSpeakerEvaluationsTable' => $baseDir . '/app/database/migrations/2014_11_28_21_create_speaker_evaluations_table.php',
    'CreateSpeakersTable' => $baseDir . '/app/database/migrations/2014_11_28_20_create_speakers_table.php',
    'CreateSupervisorsTable' => $baseDir . '/app/database/migrations/2014_11_28_02_create_supervisors_table.php',
    'CreateTrainingSchedulesTable' => $baseDir . '/app/database/migrations/2014_11_28_18_create_training_schedules_table.php',
    'CreateTrainingsTable' => $baseDir . '/app/database/migrations/2014_11_28_14_create_trainings_table.php',
    'DOMPDF' => $vendorDir . '/dompdf/dompdf/include/dompdf.cls.php',
    'DOMPDF_Exception' => $vendorDir . '/dompdf/dompdf/include/dompdf_exception.cls.php',
    'DOMPDF_Image_Exception' => $vendorDir . '/dompdf/dompdf/include/dompdf_image_exception.cls.php',
    'DashboardController' => $baseDir . '/app/controllers/DashboardController.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'Department' => $baseDir . '/app/models/Department.php',
    'Department_SC' => $baseDir . '/app/models/Department_SC.php',
    'Department_Supervisor' => $baseDir . '/app/models/Department_Supervisor.php',
    'DepartmentsController' => $baseDir . '/app/controllers/DepartmentsController.php',
    'DepartmentsTableSeeder' => $baseDir . '/app/database/seeds/DepartmentsTableSeeder.php',
    'ET_Addressed_SC' => $baseDir . '/app/models/ET_Addressed_SC.php',
    'ET_Queue' => $baseDir . '/app/models/ET_Queue.php',
    'Educational_Attainment' => $baseDir . '/app/models/Educational_Attainment.php',
    'Employee' => $baseDir . '/app/models/Employee.php',
    'Employee_Designation' => $baseDir . '/app/models/Employee_Designation.php',
    'EmployeesController' => $baseDir . '/app/controllers/EmployeesController.php',
    'EmployeesTableSeeder' => $baseDir . '/app/database/seeds/EmployeesTableSeeder.php',
    'Encoding_Map' => $vendorDir . '/phenx/php-font-lib/classes/Encoding_Map.php',
    'EntrustSetupTables' => $baseDir . '/app/database/migrations/2014_11_27_083347_entrust_setup_tables.php',
    'ExternalTrainingsController' => $baseDir . '/app/controllers/ExternalTrainingsController.php',
    'External_Training' => $baseDir . '/app/models/External_Training.php',
    'Fixed_Positioner' => $vendorDir . '/dompdf/dompdf/include/fixed_positioner.cls.php',
    'Focus_Areas' => $baseDir . '/app/models/Focus_Areas.php',
    'Font' => $vendorDir . '/phenx/php-font-lib/classes/Font.php',
    'Font_Binary_Stream' => $vendorDir . '/phenx/php-font-lib/classes/Font_Binary_Stream.php',
    'Font_EOT' => $vendorDir . '/phenx/php-font-lib/classes/Font_EOT.php',
    'Font_EOT_Header' => $vendorDir . '/phenx/php-font-lib/classes/Font_EOT_Header.php',
    'Font_Glyph_Outline' => $vendorDir . '/phenx/php-font-lib/classes/Font_Glyph_Outline.php',
    'Font_Glyph_Outline_Component' => $vendorDir . '/phenx/php-font-lib/classes/Font_Glyph_Outline_Component.php',
    'Font_Glyph_Outline_Composite' => $vendorDir . '/phenx/php-font-lib/classes/Font_Glyph_Outline_Composite.php',
    'Font_Glyph_Outline_Simple' => $vendorDir . '/phenx/php-font-lib/classes/Font_Glyph_Outline_Simple.php',
    'Font_Header' => $vendorDir . '/phenx/php-font-lib/classes/Font_Header.php',
    'Font_Metrics' => $vendorDir . '/dompdf/dompdf/include/font_metrics.cls.php',
    'Font_OpenType' => $vendorDir . '/phenx/php-font-lib/classes/Font_OpenType.php',
    'Font_OpenType_Table_Directory_Entry' => $vendorDir . '/phenx/php-font-lib/classes/Font_OpenType_Table_Directory_Entry.php',
    'Font_Table' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table.php',
    'Font_Table_Directory_Entry' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_Directory_Entry.php',
    'Font_Table_cmap' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_cmap.php',
    'Font_Table_glyf' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_glyf.php',
    'Font_Table_head' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_head.php',
    'Font_Table_hhea' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_hhea.php',
    'Font_Table_hmtx' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_hmtx.php',
    'Font_Table_kern' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_kern.php',
    'Font_Table_loca' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_loca.php',
    'Font_Table_maxp' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_maxp.php',
    'Font_Table_name' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_name.php',
    'Font_Table_name_Record' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_name_Record.php',
    'Font_Table_os2' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_os2.php',
    'Font_Table_post' => $vendorDir . '/phenx/php-font-lib/classes/Font_Table_post.php',
    'Font_TrueType' => $vendorDir . '/phenx/php-font-lib/classes/Font_TrueType.php',
    'Font_TrueType_Collection' => $vendorDir . '/phenx/php-font-lib/classes/Font_TrueType_Collection.php',
    'Font_TrueType_Header' => $vendorDir . '/phenx/php-font-lib/classes/Font_TrueType_Header.php',
    'Font_TrueType_Table_Directory_Entry' => $vendorDir . '/phenx/php-font-lib/classes/Font_TrueType_Table_Directory_Entry.php',
    'Font_WOFF' => $vendorDir . '/phenx/php-font-lib/classes/Font_WOFF.php',
    'Font_WOFF_Header' => $vendorDir . '/phenx/php-font-lib/classes/Font_WOFF_Header.php',
    'Font_WOFF_Table_Directory_Entry' => $vendorDir . '/phenx/php-font-lib/classes/Font_WOFF_Table_Directory_Entry.php',
    'Frame' => $vendorDir . '/dompdf/dompdf/include/frame.cls.php',
    'FrameList' => $vendorDir . '/dompdf/dompdf/include/frame.cls.php',
    'FrameListIterator' => $vendorDir . '/dompdf/dompdf/include/frame.cls.php',
    'FrameTreeIterator' => $vendorDir . '/dompdf/dompdf/include/frame.cls.php',
    'FrameTreeList' => $vendorDir . '/dompdf/dompdf/include/frame.cls.php',
    'Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/frame_decorator.cls.php',
    'Frame_Factory' => $vendorDir . '/dompdf/dompdf/include/frame_factory.cls.php',
    'Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/frame_reflower.cls.php',
    'Frame_Tree' => $vendorDir . '/dompdf/dompdf/include/frame_tree.cls.php',
    'GD_Adapter' => $vendorDir . '/dompdf/dompdf/include/gd_adapter.cls.php',
    'HR_Account' => $baseDir . '/app/models/HR_Account.php',
    'HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'ITAttendanceController' => $baseDir . '/app/controllers/ITAttendanceController.php',
    'IT_Addressed_SC' => $baseDir . '/app/models/IT_Addressed_SC.php',
    'IT_Participant' => $baseDir . '/app/models/IT_Participant.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'Image_Cache' => $vendorDir . '/dompdf/dompdf/include/image_cache.cls.php',
    'Image_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/image_frame_decorator.cls.php',
    'Image_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/image_frame_reflower.cls.php',
    'Image_Renderer' => $vendorDir . '/dompdf/dompdf/include/image_renderer.cls.php',
    'Inline_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/inline_frame_decorator.cls.php',
    'Inline_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/inline_frame_reflower.cls.php',
    'Inline_Positioner' => $vendorDir . '/dompdf/dompdf/include/inline_positioner.cls.php',
    'Inline_Renderer' => $vendorDir . '/dompdf/dompdf/include/inline_renderer.cls.php',
    'InternalTrainingsController' => $baseDir . '/app/controllers/InternalTrainingsController.php',
    'Internal_Training' => $baseDir . '/app/models/Internal_Training.php',
    'Javascript_Embedder' => $vendorDir . '/dompdf/dompdf/include/javascript_embedder.cls.php',
    'Line_Box' => $vendorDir . '/dompdf/dompdf/include/line_box.cls.php',
    'List_Bullet_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/list_bullet_frame_decorator.cls.php',
    'List_Bullet_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/list_bullet_frame_reflower.cls.php',
    'List_Bullet_Image_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/list_bullet_image_frame_decorator.cls.php',
    'List_Bullet_Positioner' => $vendorDir . '/dompdf/dompdf/include/list_bullet_positioner.cls.php',
    'List_Bullet_Renderer' => $vendorDir . '/dompdf/dompdf/include/list_bullet_renderer.cls.php',
    'Maatwebsite\\Excel\\Classes\\Cache' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Classes/Cache.php',
    'Maatwebsite\\Excel\\Classes\\FormatIdentifier' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Classes/FormatIdentifier.php',
    'Maatwebsite\\Excel\\Classes\\LaravelExcelWorksheet' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Classes/LaravelExcelWorksheet.php',
    'Maatwebsite\\Excel\\Classes\\PHPExcel' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Classes/PHPExcel.php',
    'Maatwebsite\\Excel\\Collections\\CellCollection' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Collections/CellCollection.php',
    'Maatwebsite\\Excel\\Collections\\ExcelCollection' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Collections/ExcelCollection.php',
    'Maatwebsite\\Excel\\Collections\\RowCollection' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Collections/RowCollection.php',
    'Maatwebsite\\Excel\\Collections\\SheetCollection' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Collections/SheetCollection.php',
    'Maatwebsite\\Excel\\Excel' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Excel.php',
    'Maatwebsite\\Excel\\ExcelServiceProvider' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/ExcelServiceProvider.php',
    'Maatwebsite\\Excel\\Exceptions\\LaravelExcelException' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Exceptions/LaravelExcelException.php',
    'Maatwebsite\\Excel\\Facades\\Excel' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Facades/Excel.php',
    'Maatwebsite\\Excel\\Files\\ExcelFile' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Files/ExcelFile.php',
    'Maatwebsite\\Excel\\Files\\ExportHandler' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Files/ExportHandler.php',
    'Maatwebsite\\Excel\\Files\\File' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Files/File.php',
    'Maatwebsite\\Excel\\Files\\ImportHandler' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Files/ImportHandler.php',
    'Maatwebsite\\Excel\\Files\\NewExcelFile' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Files/NewExcelFile.php',
    'Maatwebsite\\Excel\\Filters\\ChunkReadFilter' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Filters/ChunkReadFilter.php',
    'Maatwebsite\\Excel\\Parsers\\CssParser' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Parsers/CssParser.php',
    'Maatwebsite\\Excel\\Parsers\\ExcelParser' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Parsers/ExcelParser.php',
    'Maatwebsite\\Excel\\Parsers\\ViewParser' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Parsers/ViewParser.php',
    'Maatwebsite\\Excel\\Readers\\Batch' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Readers/Batch.php',
    'Maatwebsite\\Excel\\Readers\\ConfigReader' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Readers/ConfigReader.php',
    'Maatwebsite\\Excel\\Readers\\Html' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Readers/HtmlReader.php',
    'Maatwebsite\\Excel\\Readers\\LaravelExcelReader' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Readers/LaravelExcelReader.php',
    'Maatwebsite\\Excel\\Writers\\CellWriter' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Writers/CellWriter.php',
    'Maatwebsite\\Excel\\Writers\\LaravelExcelWriter' => $vendorDir . '/maatwebsite/excel/src/Maatwebsite/Excel/Writers/LaravelExcelWriter.php',
    'NavBarComposer' => $baseDir . '/app/composers/NavBarComposer.php',
    'Notification' => $baseDir . '/app/models/Notification.php',
    'NotificationRepository' => $baseDir . '/app/repositories/NotificationRepository.php',
    'Null_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/null_frame_decorator.cls.php',
    'Null_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/null_frame_reflower.cls.php',
    'Null_Positioner' => $vendorDir . '/dompdf/dompdf/include/null_positioner.cls.php',
    'PDFLib_Adapter' => $vendorDir . '/dompdf/dompdf/include/pdflib_adapter.cls.php',
    'PHP_Evaluator' => $vendorDir . '/dompdf/dompdf/include/php_evaluator.cls.php',
    'Page_Cache' => $vendorDir . '/dompdf/dompdf/include/page_cache.cls.php',
    'Page_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/page_frame_decorator.cls.php',
    'Page_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/page_frame_reflower.cls.php',
    'Participant_Assessment' => $baseDir . '/app/models/Participant_Assessment.php',
    'Participant_Attendance' => $baseDir . '/app/models/Participant_Attendance.php',
    'ParticipantsController' => $baseDir . '/app/controllers/ParticipantsController.php',
    'Permission' => $baseDir . '/app/models/Permission.php',
    'Permission_Role' => $baseDir . '/app/models/Permission_Role.php',
    'PermissionsTableSeeder' => $baseDir . '/app/database/seeds/PermissionsTableSeeder.php',
    'Position' => $baseDir . '/app/models/Position.php',
    'Position_SC' => $baseDir . '/app/models/Position_SC.php',
    'Positioner' => $vendorDir . '/dompdf/dompdf/include/positioner.cls.php',
    'PositionsController' => $baseDir . '/app/controllers/PositionsController.php',
    'PositionsTableSeeder' => $baseDir . '/app/database/seeds/PositionsTableSeeder.php',
    'Program_Supervisor' => $baseDir . '/app/models/Program_Supervisor.php',
    'Rank' => $baseDir . '/app/models/Rank.php',
    'RanksController' => $baseDir . '/app/controllers/RanksController.php',
    'RanksTableSeeder' => $baseDir . '/app/database/seeds/RanksTableSeeder.php',
    'Renderer' => $vendorDir . '/dompdf/dompdf/include/renderer.cls.php',
    'ReportsController' => $baseDir . '/app/controllers/ReportsController.php',
    'Role' => $baseDir . '/app/models/Role.php',
    'RolesController' => $baseDir . '/app/controllers/RolesController.php',
    'RolesTableSeeder' => $baseDir . '/app/database/seeds/RolesTableSeeder.php',
    'School_College' => $baseDir . '/app/models/School_College.php',
    'School_College_Supervisor' => $baseDir . '/app/models/School_College_Supervisor.php',
    'SchoolsCollegesController' => $baseDir . '/app/controllers/SchoolsCollegesController.php',
    'SchoolsCollegesTableSeeder' => $baseDir . '/app/database/seeds/SchoolsCollegesTableSeeder.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'SkillsCompetencies' => $baseDir . '/app/models/SkillsCompetencies.php',
    'SkillsCompetenciesController' => $baseDir . '/app/controllers/SkillsCompetenciesController.php',
    'SkillsCompetenciesTableSeeder' => $baseDir . '/app/database/seeds/SkillsCompetenciesTableSeeder.php',
    'Speaker' => $baseDir . '/app/models/Speaker.php',
    'Speaker_Evaluation' => $baseDir . '/app/models/Speaker_Evaluation.php',
    'SpeakersController' => $baseDir . '/app/controllers/SpeakersController.php',
    'Style' => $vendorDir . '/dompdf/dompdf/include/style.cls.php',
    'Stylesheet' => $vendorDir . '/dompdf/dompdf/include/stylesheet.cls.php',
    'SummaryReportsController' => $baseDir . '/app/controllers/SummaryReportsController.php',
    'Supervisor' => $baseDir . '/app/models/Supervisor.php',
    'TCPDF_Adapter' => $vendorDir . '/dompdf/dompdf/include/tcpdf_adapter.cls.php',
    'Table_Cell_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/table_cell_frame_decorator.cls.php',
    'Table_Cell_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/table_cell_frame_reflower.cls.php',
    'Table_Cell_Positioner' => $vendorDir . '/dompdf/dompdf/include/table_cell_positioner.cls.php',
    'Table_Cell_Renderer' => $vendorDir . '/dompdf/dompdf/include/table_cell_renderer.cls.php',
    'Table_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/table_frame_decorator.cls.php',
    'Table_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/table_frame_reflower.cls.php',
    'Table_Row_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/table_row_frame_decorator.cls.php',
    'Table_Row_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/table_row_frame_reflower.cls.php',
    'Table_Row_Group_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/table_row_group_frame_decorator.cls.php',
    'Table_Row_Group_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/table_row_group_frame_reflower.cls.php',
    'Table_Row_Group_Renderer' => $vendorDir . '/dompdf/dompdf/include/table_row_group_renderer.cls.php',
    'Table_Row_Positioner' => $vendorDir . '/dompdf/dompdf/include/table_row_positioner.cls.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
    'Text_Frame_Decorator' => $vendorDir . '/dompdf/dompdf/include/text_frame_decorator.cls.php',
    'Text_Frame_Reflower' => $vendorDir . '/dompdf/dompdf/include/text_frame_reflower.cls.php',
    'Text_Renderer' => $vendorDir . '/dompdf/dompdf/include/text_renderer.cls.php',
    'Training' => $baseDir . '/app/models/Training.php',
    'TrainingAssessmentsController' => $baseDir . '/app/controllers/TrainingAssessmentsController.php',
    'TrainingPlanController' => $baseDir . '/app/controllers/TrainingPlanController.php',
    'TrainingResponsesController' => $baseDir . '/app/controllers/TrainingResponsesController.php',
    'Training_Schedule' => $baseDir . '/app/models/Training_Schedule.php',
    'UploadsController' => $baseDir . '/app/controllers/UploadsController.php',
    'User' => $baseDir . '/app/models/User.php',
    'UserRepository' => $baseDir . '/app/models/UserRepository.php',
    'UsersController' => $baseDir . '/app/controllers/UsersController.php',
    'UsersTableSeeder' => $baseDir . '/app/database/seeds/UsersTableSeeder.php',
    'Whoops\\Module' => $vendorDir . '/filp/whoops/src/deprecated/Zend/Module.php',
    'Whoops\\Provider\\Zend\\ExceptionStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/ExceptionStrategy.php',
    'Whoops\\Provider\\Zend\\RouteNotFoundStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/RouteNotFoundStrategy.php',
    'Zizaco\\Confide\\ControllerCommand' => $vendorDir . '/zizaco/confide/src/commands/ControllerCommand.php',
    'Zizaco\\Confide\\MigrationCommand' => $vendorDir . '/zizaco/confide/src/commands/MigrationCommand.php',
    'Zizaco\\Confide\\RoutesCommand' => $vendorDir . '/zizaco/confide/src/commands/RoutesCommand.php',
    'Zizaco\\Entrust\\MigrationCommand' => $vendorDir . '/zizaco/entrust/src/commands/MigrationCommand.php',
);
