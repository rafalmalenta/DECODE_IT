<?php
//Na dobry początek zajmiemy się czymś, co da Ci dobry pogląd na to z czym trzeba będzie się zmierzyć. Jedna osoba z naszej ekipy pracuje nad miejscem, które będzie dobre jako punkt obserwacyjny do kolejnego zlecenia. Spory ogród na dachu jednego z okolicznych biurowców wydaje się do tego idealny. Tom z naszej grupy zatrudnił się tam jako ogrodnik, aby mieć lepszy dostęp do miejsca i wtopić się w tłum.
//Jednym z obowiązków Toma jest odpowiednie dbanie o rośliny. Ma przynieść specjalny nawóz, którym nawilży każdą z nich. Na każdy metr kwadratowy przypada jedna paczka nawozu, a ogród ma C metrów kwadratowych. Tom ma plecak, ale jest słaby i udźwignie tylko K kilogramów, gdzie każda paczka waży W kg. Pomóż mu ogarnąć czy da radę przynieść wszystko jak należy tak, aby go nie wylali i nie spalił miejscówki.

//W pierwszej linii jedna dodatnia liczba całkowita t≤100 oznaczająca liczba testów (Tom został poproszony o przyniesienie odżywek kilka razy). Następnie t linii, każda zawierająca trzy liczby: c, k, w, gdzie 1≤c,k,w≤100.
//br
//t [liczba testów]
//c k w [liczba metrów, udźwig Toma oraz waga nawozu]
//c k w [następny test]

$stdin = fopen('php://stdin', 'r');

$t = (int)trim(fgets($stdin));

if (is_integer($t)) {
    for ($i = 0; $i < $t; $i++) {
        $line = explode(" ", trim(fgets($stdin)));
        $c = $line[0];
        $k = $line[1];
        $w = $line[2];
        if (floor($k / $w) >= $c) {
            $output[] = "yes";
        } else
            $output[] = "no";
    }
}
foreach ($output as $el)
    echo "$el\n";