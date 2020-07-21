<?php 
	get_header(); 
	if ( !$wpdb ) {
		$wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );
	} else {
		global $wpdb;
	}
?>
	<main>
		<section id="vocabulary">
			<div class="container">
				<?php the_title( $before = '<h1>', $after = '</h1>', $echo = true ) ?>
			</div>
		</section>
		<section id="wordSearch">
			<div class="container">
				<h2 class="section__heading">Поиск перевода</h2>
				<form id="wordSearch">
					<div class="row">
						<div class="col-md-8 m-auto">
							<div class="mb-3">
								<label for="unknowWord" class="form-label">Слово которое надо перевести</label>
								<input type="text" class="form-control" id="unknowWord" placeholder="Например: привет">
							</div>
							<input type="submit" class="form-control" value="Найти">
							<div class="my-3">
								<?php 

									$newtable = $wpdb -> get_var("SELECT word FROM {$wpdb -> vocabulary}");

									// print_r($newtable[0]);
									echo($newtable);
									echo "<br>";

									$user_count = $wpdb -> get_var("SELECT COUNT(*) FROM {$wpdb -> users}");
									echo '<p>Количество пользователей равно: ' . $user_count. '</p>';

									$some = $wpdb -> get_var($wpdb->prepare(
										"SELECT word FROM {$wpdb->vocabulary}"
									));
									echo $some;
									### Общее Количество страниц
									function get_totalpages() {
										global $wpdb;
										$totalpages = intval( $wpdb->get_var(
											"SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'page' AND post_status = 'publish'"
										));

										return $totalpages;
									}
									echo ('Количество страниц: ' . get_totalpages());

									

								 ?>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<section id="wordAppend">
			<div class="container">
				<form>
					<div class="row">
						<div class="col-md-8 m-auto">
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" placeholder="Слово" aria-label="wordToTranslate">
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Перевод" aria-label="translate">
								</div>
							</div>
							<input type="submit" class="form-control" onclick="requestAjax(e)" value="Добавить">	
						</div>
					</div>
					<div id="resultTranslate"></div>
				</form>
			</div>
		</section>
	</main>

<?php get_footer(); ?>