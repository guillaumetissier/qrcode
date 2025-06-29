<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class BottomExtensionPatternsPositions extends AbstractVersionDependentPositions
{
    public function getPositions(): \Generator
    {
        $patternCount = floor($this->getVersion()->value / 2);

        for ($i = 0, $firstCol = 8; $i < $patternCount; $i++, $firstCol += 8) {
            for ($col = 0; $col < 4; $col++) {
                for ($row = 0; $row < 2; $row++) {
                    yield new Position($firstCol + $col, $row);
                }
            }
        }
    }
}
