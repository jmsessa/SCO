<?php 
    $course_id = tutor_utils()->get_course_id_by( 'lesson', get_the_ID() );
    
    $args = array(
        'headline' => __( 'Permissão Negada', 'tutor' ),
        'message' =>  __( 'Inscreva-se neste curso para visualizar o conteúdo do curso.', 'tutor' ),
        'description' => sprintf( __( 'Nome do Curso: %s', 'tutor' ), get_the_title( $course_id ) ),
        'button' => array(
            'url' => get_permalink( $course_id ),
            'text' =>  __( 'Vizualizar Curso', 'tutor' )
        )
    );

    tutor_load_template('permission-denied', $args); 
?>