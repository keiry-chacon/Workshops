<?php
// Temperaturas registradas
$temperatures = array(78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73);

// Calcular la temperatura promedio
$total_temperatures  = count($temperatures);
$sum_temperatures    = array_sum($temperatures);
$average_temperature = $sum_temperatures / $total_temperatures;

// Eliminar duplicados y ordenar las temperaturas
$unique_temperatures = array_unique($temperatures);
sort($unique_temperatures);

// Mostrar las 5 temperaturas más bajas
$lowest_temperatures = array_slice($unique_temperatures, 0, 5);
echo "Top 5 temperaturas más bajas: " . implode(", ", $lowest_temperatures) . "-  ";

// Mostrar las 5 temperaturas más altas
$highest_temperatures = array_slice($unique_temperatures, -5);
echo "Top 5 temperaturas más altas: " . implode(", ", $highest_temperatures) . "-  ";
?>
