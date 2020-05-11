<?php

namespace Book\Services;

class GoogleBookService
{
    const API_ENDPOINT = 'https://www.googleapis.com/books/v1/volumes?';
    private $token;

    public function __construct()
    {
        $this->token = config('app.google_book_token');
    }
    public function getBooksByTitle($query, $startIndex, $perPage, $lang)
    {
        $fields = http_build_query([
            'printType' => 'books',
            'key' => $this->token,
            'startIndex' => $startIndex,
            'maxResults' => $perPage,
            'langRestrict' => $lang,
            'q' => "intitle:$query",
        ]);

        $books = $this->getResponse($fields);
        $normalizedBooks = [];

        foreach ($books as $book) {
            $normalizedBooks[] = $this->normalize($book);
        }

        return $normalizedBooks;
    }

    protected function getResponse($fields)
    {
        $content = file_get_contents(self::API_ENDPOINT . $fields, false);
        $data = json_decode($content);
        $books = $data->items ?? [];

        return $books;
    }

    protected function normalize($book)
    {
        $bookInfo = $book->volumeInfo ?? null;
        $resultBook = [];

        if ($bookInfo) {
            $isbn = '';
            $isbns = $bookInfo->industryIdentifiers ?? [];
            foreach ($isbns as $isbn) {
                if (
                    isset($isbn->type)
                    && $isbn->type === 'ISBN_13'
                ) {
                    $isbn = $isbn->identifier ?? '';
                    break;
                }
            }

            $resultBook = [
                'book_id' => $book->id ?? null,
                'title' => $bookInfo->title ?? 'None',
                'subtitle' => $bookInfo->subtitle ?? '',
                'description' => $bookInfo->description ?? 'None',
                'isbn' => $isbn,
                'persons' => $bookInfo->authors ?? [],
                'tags' => $bookInfo->categories ?? [],
                'imageLink' => $bookInfo->imageLinks->smallThumbnail ?? '',
                'publisher' => $bookInfo->publisher ?? 'None',
                'publishedDate' => $bookInfo->publishedDate ?? 'None',
            ];
        }

        return $resultBook;
    }
}
