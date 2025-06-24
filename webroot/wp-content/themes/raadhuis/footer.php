    <footer id="footer" class="footer">
        <div class="container">
            <!-- Footer content -->
        </div>
    </footer>

    <?php if (current_user_can('administrator')): ?>

        <div class="flex items-center m-2 fixed bottom-0 right-0 border border-content-300 rounded p-2 bg-white bg-opacity-80 text-dark text-sm">
            <?= __('Breakpoint:', 'raadhuis-wp'); ?>
            <span class="ml-1 sm:hidden md:hidden lg:hidden xl:hidden font-extrabold">xs</span>
            <span class="ml-1 hidden sm:inline md:hidden font-extrabold">sm</span>
            <span class="ml-1 hidden md:inline lg:hidden font-extrabold">md</span>
            <span class="ml-1 hidden lg:inline xl:hidden font-extrabold">lg</span>
            <span class="ml-1 hidden xl:inline 2xl:hidden 3xl:hidden 4xl:hidden 5xl:hidden 6xl:hidden font-extrabold">xl</span>
            <span class="ml-1 hidden 2xl:inline 3xl:hidden 4xl:hidden 5xl:hidden 6xl:hidden font-extrabold">2xl</span>
            <span class="ml-1 hidden 3xl:inline 4xl:hidden 5xl:hidden 6xl:hidden font-extrabold">3xl</span>
            <span class="ml-1 hidden 4xl:inline 5xl:hidden 6xl:hidden font-extrabold">4xl</span>
            <span class="ml-1 hidden 5xl:inline 6xl:hidden font-extrabold">5xl</span>
            <span class="ml-1 hidden 6xl:inline font-extrabold">6xl (last)</span>
        </div>

    <?php endif; ?>

    </div>

    <?php wp_footer(); ?>

    </body>

    </html>