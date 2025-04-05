<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="mt-12">
  <?php if (have_comments()) : ?>
    <h2 class="text-2xl font-semibold text-green-600 mb-4">
      <?php
      printf(
        _nx('Un comentario', '%1$s comentarios', get_comments_number(), 'comments title'),
        number_format_i18n(get_comments_number())
      );
      ?>
    </h2>

    <ol class="space-y-6">
      <?php
      wp_list_comments(array(
        'style'      => 'ol',
        'short_ping' => true,
        'avatar_size' => 50,
        'callback' => function ($comment, $args, $depth) {
          ?>
          <li <?php comment_class('bg-white/60 backdrop-blur-md rounded-xl p-4 shadow'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="flex items-start gap-4">
              <?php echo get_avatar($comment, 50, '', '', ['class' => 'rounded-full']); ?>
              <div>
                <p class="font-semibold text-green-600"><?php comment_author(); ?></p>
                <time class="text-gray-500 text-sm"><?php comment_date(); ?> a las <?php comment_time(); ?></time>
                <div class="text-gray-700 mt-2"><?php comment_text(); ?></div>
                <?php if ($comment->comment_approved == '0') : ?>
                  <em class="text-yellow-500">Tu comentario está en espera de moderación.</em>
                <?php endif; ?>
                <div class="mt-2 text-sm">
                  <?php comment_reply_link(array_merge($args, [
                    'reply_text' => 'Responder',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                  ])); ?>
                </div>
              </div>
            </div>
          </li>
          <?php
        }
      ));
      ?>
    </ol>
  <?php endif; ?>

  <?php if (comments_open()) : ?>
    <div class="mt-10">
      <h3 class="text-xl font-bold text-green-600 mb-4">Deja un comentario</h3>
      <?php
      comment_form(array(
        'class_form' => 'space-y-4',
        'class_submit' => 'bg-green-500 text-white font-semibold px-6 py-2 rounded-full hover:bg-green-600 transition',
        'comment_field' => '<textarea id="comment" name="comment" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required></textarea>',
        'fields' => array(
          'author' => '<input id="author" name="author" type="text" placeholder="Nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>',
          'email'  => '<input id="email" name="email" type="email" placeholder="Correo electrónico" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>',
        ),
      ));
      ?>
    </div>
  <?php endif; ?>
</div>
