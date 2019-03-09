<?php

namespace App\Console\Commands;

use App\Logic\Cache\CacheRepository;
use Illuminate\Console\Command;

class CachePages extends Command
{
    /**
     * Cache Repository Instance
     *
     * @var
     */
    protected $cache;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anand:cache {type : The type of page you want to generate home, posts, tags, categories, authors or all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate cached versions of pages.';

    /**
     * CachePages constructor.
     * @param CacheRepository $cacheRepository
     */
    public function __construct(CacheRepository $cacheRepository)
    {
        parent::__construct();
        $this->cache = $cacheRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->argument('type');

        $this->cache->storePage($type);
    }
}
