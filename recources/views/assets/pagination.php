
<div class="flex items-center justify-between border-t border-white/10 px-4 py-3 sm:px-6">
  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-300">
        Mostrando
        <span class="font-medium"><?= $$paginate['from'] ?></span>
        a
        <span class="font-medium"><?= $$paginate['to'] ?></span>
        de
        <span class="font-medium"><?= $$paginate['total'] ?></span>
        resultados
      </p>
    </div>
    <div>
      <nav aria-label="Pagination" class="isolate inline-flex -space-x-px rounded-md">
        <a href="<?= $$paginate['prev'] ?>" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 inset-ring inset-ring-gray-700 hover:bg-white/5 focus:z-20 focus:outline-offset-0">
          <span class="sr-only">Previous</span>
          <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
            <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
          </svg>
        </a>
        <?php for ($i = 1; $i <= $$paginate['last_page']; $i++): ?>
            <a href="<?= "contacts?page="?><?= $i ?> <?= isset($_GET['search']) ? "&search=" . $_GET['search'] : "" ?>"   class="<?= $$paginate['page'] == $i ? 'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-200 inset-ring inset-ring-gray-700 hover:bg-white/5 focus:z-20 focus:outline-offset-0' : 'relative inline-flex items-center px-4 py-2 text-sm  text-black inset-ring inset-ring-gray-700 hover:bg-white/5 focus:z-20 focus:outline-offset-0'?>"><?= $i ?></a>
        <?php endfor ?>
        
        <a href="<?= $$paginate['next'] ?>" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 inset-ring inset-ring-gray-700 hover:bg-white/5 focus:z-20 focus:outline-offset-0">
          <span class="sr-only">Next</span>
          <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
            <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
          </svg>
        </a>
      </nav>
    </div>
  </div>
</div>