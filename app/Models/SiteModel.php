<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class SiteModel extends Model
{
    public static function getAllServices($pagination = null)
    {
        try {
            $cacheKey = 'all_services_' . ($pagination ?? 'all');
            // Cache::forget($cacheKey);
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($pagination) {
                return DB::transaction(function () use ($pagination) {
                    $query = DB::table('services')
                        ->select('*')
                        ->whereNull('category')
                        ->where('status', 'Active')
                        ->orderBy('id', 'desc');

                    return $pagination ? $query->paginate($pagination) : $query->get();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching all services: ' . $e->getMessage());
            return collect();
        }
    }

    public static function getAllHeaderServices($category)
    {
        try {
            $cacheKey = "{$category}_services";
            // Cache::forget($cacheKey);
            return Cache::remember(
                $cacheKey,
                now()->addWeek(),
                function () use ($category) {
                    return DB::transaction(function () use ($category) {
                        return DB::table('services')
                            ->select('*')
                            ->where('status', 'Active')
                            ->where('category', $category)
                            ->get();
                    });
                }
            );
        } catch (\Exception $e) {
            Log::error('Error fetching all services: ' . $e->getMessage());
            return collect();
        }
    }

    public static function getServiceBySlug($slug)
    {
        try {
            $cacheKey = "service_by_slug_{$slug}";
            // Cache::forget($cacheKey);
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($slug) {
                return DB::transaction(function () use ($slug) {
                    return DB::table('services')
                        ->select('*')
                        ->where('slug', $slug)
                        ->where('status', 'Active')
                        ->first();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching service by slug: ' . $e->getMessage());
            return null;
        }
    }

    public static function getAllTechnologies($pagination = null)
    {
        try {
            $cacheKey = 'all_technologies_' . ($pagination ?? 'all');
            // Cache::forget($cacheKey);
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($pagination) {
                return DB::transaction(function () use ($pagination) {
                    $query = DB::table('technologies')
                        ->select('*')
                        ->where('status', 'Active');

                    return $pagination ? $query->paginate($pagination) : $query->get();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching all technologies: ' . $e->getMessage());
            return collect();
        }
    }

    public static function getAlltechnolgiesByCategory($category)
    {
        try {
            $cacheKey = "{$category}_technologies";
            // Cache::forget($cacheKey);
            return Cache::remember(
                $cacheKey,
                now()->addWeek(),
                function () use ($category) {
                    return DB::transaction(function () use ($category) {
                        return DB::table('technologies')
                            ->select('*')
                            ->where('status', 'Active')
                            ->where('category', $category)
                            ->get();
                    });
                }
            );
        } catch (\Exception $e) {
            Log::error('Error fetching all technologies: ' . $e->getMessage());
            return collect();
        }
    }

    public static function getTechnologyBySlug($slug)
    {
        try {
            $cacheKey = "technology_by_slug_{$slug}";
            // Cache::forget($cacheKey);
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($slug) {
                return DB::transaction(function () use ($slug) {
                    return DB::table('technologies')
                        ->select('*')
                        ->where('slug', $slug)
                        ->where('status', 'Active')
                        ->first();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching technology by slug: ' . $e->getMessage());
            return null;
        }
    }

    public static function getAllBlogs($pagination = null)
    {
        try {
            $cacheKey = 'all_blogs_' . ($pagination ?? 'all');
            Cache::forget($cacheKey);
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($pagination) {
                return DB::transaction(function () use ($pagination) {
                    $query = DB::table('blogs')
                        ->select('blogs.*', 'blog_categories.name as category_name', 'users.name as author_name')
                        ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                        ->leftJoin('users', 'blogs.author_id', '=', 'users.id')
                        ->where('blogs.status', 'published')
                        ->whereNotNull('blogs.published_at')
                        ->whereRaw('blogs.published_at <= NOW()')
                        ->orderBy('blogs.published_at', 'desc');

                    return $pagination ? $query->paginate($pagination) : $query->get();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching all blogs: ' . $e->getMessage());
            return collect();
        }
    }

    public static function getBlogBySlug($slug)
    {
        try {
            $cacheKey = "blog_by_slug_{$slug}";
            Cache::forget($cacheKey);
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($slug) {
                return DB::transaction(function () use ($slug) {
                    return DB::table('blogs')
                        ->select('blogs.*', 'blog_categories.name as category_name', 'users.name as author_name')
                        ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                        ->leftJoin('users', 'blogs.author_id', '=', 'users.id')
                        ->where('blogs.slug', $slug)
                        ->where('blogs.status', 'published')
                        ->whereNotNull('blogs.published_at')
                        ->whereRaw('blogs.published_at <= NOW()')
                        ->first();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching blog by slug: ' . $e->getMessage());
            return null;
        }
    }

    public static function getRelatedBlogs($currentBlogId, $categoryId, $limit = 3)
    {
        try {
            $cacheKey = "related_blogs_{$currentBlogId}_{$categoryId}";
            return Cache::remember($cacheKey, now()->addWeek(), function () use ($currentBlogId, $categoryId, $limit) {
                return DB::transaction(function () use ($currentBlogId, $categoryId, $limit) {
                    return DB::table('blogs')
                        ->select('blogs.*', 'blog_categories.name as category_name')
                        ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
                        ->where('blogs.id', '!=', $currentBlogId)
                        ->where('blogs.category_id', $categoryId)
                        ->where('blogs.status', 'published')
                        ->whereNotNull('blogs.published_at')
                        ->where('blogs.published_at', '<=', now())
                        ->orderBy('blogs.published_at', 'desc')
                        ->limit($limit)
                        ->get();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching related blogs: ' . $e->getMessage());
            return collect();
        }
    }

    public static function getBlogCategories()
    {
        try {
            $cacheKey = 'blog_categories';
            return Cache::remember($cacheKey, now()->addWeek(), function () {
                return DB::transaction(function () {
                    return DB::table('blog_categories')
                        ->select('*')
                        ->orderBy('name')
                        ->get();
                });
            });
        } catch (\Exception $e) {
            Log::error('Error fetching blog categories: ' . $e->getMessage());
            return collect();
        }
    }
}
