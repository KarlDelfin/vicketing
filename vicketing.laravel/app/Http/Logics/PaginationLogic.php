<?php
    namespace App\Http\Logics;
    class PaginationLogic
    {
        public function paginateData($data, $paginationRequest)
        {
            $data = $data->toArray();
            $totalElements = count($data);
            $totalPages = ceil($totalElements / $paginationRequest['elementsPerPage']);
            $start = ($paginationRequest['currentPage'] - 1) * $paginationRequest['elementsPerPage'];
            $end = $paginationRequest['currentPage'] * $paginationRequest['elementsPerPage'];
            $results = array_slice($data, $start, $paginationRequest['elementsPerPage']);
            return [
                'currentPage' => $paginationRequest['currentPage'],
                'elementsPerPage' => $paginationRequest['elementsPerPage'],
                'totalElements' => $totalElements,
                'totalPages' => $totalPages,
                'results' => $results,
            ];
        }
    }
?>
