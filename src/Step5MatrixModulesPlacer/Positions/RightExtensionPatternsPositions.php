<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class RightExtensionPatternsPositions extends AbstractVersionDependentPositions
{
    public function getPositions(): \Generator
    {
        $patternCount = floor($this->getVersion()->value / 2);

        for ($i = 0, $firstRow = 8; $i < $patternCount; $i++, $firstRow += 8) {
            for ($row = 0; $row < 4; $row++) {
                for ($col = 0; $col < 2; $col++) {
                    yield new Position($col, $firstRow + $row);
                }
            }
        }
    }
}
