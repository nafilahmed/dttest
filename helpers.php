<?php

function consoleTable($data): void {
    if (is_null($data)) {
        echo "(null)\n";
        return;
    }

    if (is_string($data)) {
        echo $data . "\n";
        return;
    }

    if (is_object($data) && is_a($data, 'Illuminate\Support\Collection')) {
        $data = $data->all();
    }

    $headers = array_merge(['(index)'], consoleTableHeaders($data));

    $table = new LucidFrame\Console\ConsoleTable();
    $table->setHeaders($headers);

    $rows = consoleTableRows($data);

    foreach ($rows as $rowIndex => $row) {
        if (! is_array($row)) {
            $row = [$row];
        }

        $table->addRow(array_merge([$rowIndex], array_values($row)));
    }

    $table->display();
}

function consoleTableHeaders(array $data): array
{
    $headers = [];

    foreach ($data as $row) {
        if (! is_array($row)) {
            return ['Value'];
        }

        foreach ($row as $key => $val) {
            if (! in_array($key, $headers)) {
                $headers[] = $key;
            }
        }
    }

    return $headers;
}

function consoleTableRows(array $data): array
{
    $headers = array_flip(consoleTableHeaders($data));

    foreach ($headers as $key => $val) {
        $headers[$key] = 0;
    }

    foreach ($data as &$row) {
        if (is_array($row)) {
            $row = array_merge($headers, $row);
        }
    }

    return $data;
}

function consoleLog(...$params): void {
    foreach ($params as $param) {
        echo $param . ' ';
    }

    echo PHP_EOL;
}
