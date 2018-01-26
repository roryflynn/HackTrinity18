"""empty message

Revision ID: b4324033a142
Revises: dcf4e70b0b6f
Create Date: 2018-01-26 10:23:16.305455

"""
from alembic import op
import sqlalchemy as sa


# revision identifiers, used by Alembic.
revision = 'b4324033a142'
down_revision = 'dcf4e70b0b6f'
branch_labels = None
depends_on = None


def upgrade():
    op.drop_constraint("name", "teams", "unique")


def downgrade():
    op.create_unique_constraint(None, "teams", ["name"])