<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class ExtensionPatternsPositions extends AbstractVersionDependentPositions
{
    public function getPositions(): \Generator
    {
        $patternCount = floor($this->getVersion()->value / 2);

        yield new Position(0, 0);
        for ($i = 0, $position = 8; $i < $patternCount; ++$i, $position += 8) {
            yield new Position($position, 0);
            yield new Position(0, $position);
        }
    }
}
