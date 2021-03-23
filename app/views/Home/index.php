<main>
	<?php if (!$DATA['user']): ?>
	<p>Excuse Yourself.  You're Not logged in!</p>
	<?php else: ?>
	<p>Welcome, <?= Security::escape($DATA['user']); ?>!</p>
	<?php endif; ?>
</main>
