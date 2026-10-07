<?php
declare(strict_types=1); 
$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];
 
$estrela = $usuario["premium"] ? " ⭐" : "";

echo "<div>";
echo "<h2>" . $usuario["nome"] . $estrela . "</h2>";
echo "<p>Idade: " . $usuario["idade"] . " anos</p>";
echo "<p>Localização: " . $usuario["cidade"] . " - " . $usuario["estado"] . "</p>";
echo "</div>";
